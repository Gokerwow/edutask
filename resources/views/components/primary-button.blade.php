<button {{ $attributes->merge(['type' => 'submit', 'class' => 'pushable ']) }}>
    <span class="shadow"></span>
    <span class="edge"></span>
    <span class="front">  {{ $slot }} </span>
</button>
