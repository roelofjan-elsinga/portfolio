<form action="{{route('contact')}}" method="post">
    <div class="w-full md:w-1/2 mt-4">
        @csrf
        <input type="text" name="name" class="bg-white shadow rounded p-4 text-theme-darkest mb-2 text-lg" placeholder="Your name" required>
        <input type="email" value="" name="email" class="bg-white shadow rounded p-4 text-theme-darkest mb-2 text-lg" placeholder="Your Email Address" required>
        <textarea name="message" class="bg-white shadow rounded block w-full p-4 text-theme-darkest mb-2 text-lg" rows="10" placeholder="Your message" required></textarea>
        <div class="h-captcha" data-sitekey="{{config('services.hcaptcha.key')}}"></div>
        <button type="submit" class="bg-theme-dark text-white p-4 rounded text-lg">Send message</button>
    </div>
</form>

<link rel="preload" href="https://www.hCaptcha.com/1/api.js" as="script">
<script src='https://www.hCaptcha.com/1/api.js' async defer></script>
