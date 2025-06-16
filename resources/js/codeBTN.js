const generateCodeBtn = document.getElementById('generateCodeBtn');
const classCodeInput = document.getElementById('class-code');

generateCodeBtn.addEventListener('click', generateCode)

async function generateCode() {
    const firstStr = 'EDU';
    const randomize = Math.random().toString(36).substring(2, 5).toUpperCase();

    let code = firstStr + randomize;

    try {
        const response = await fetch('/api/generateCode', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            },
            body: JSON.stringify({ classCodeInput: code })
        });

        const data = await response.json();

        if (!response.ok) {
            console.error('Server error while checking code:', data.message || response.statusText);
            classCodeInput.value = ''; // Kosongkan atau beri pesan error
            return; // Keluar dari fungsi jika ada error server yang signifikan
        }

        if (data.exists) {
            console.log('Code already exists, generating a new one...');
            generateCode();
        } else {
            console.log('Generated code:', code);
            classCodeInput.value = code;
        }

    } catch (error) {
        console.error('Error :', error);
        classCodeInput.value = ''; // Kosongkan atau beri pesan error
        return; // Keluar dari fungsi jika ada error jaringan/parsing
    }
}
