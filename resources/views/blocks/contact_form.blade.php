<form action="{{route('contact')}}" method="post">
    <div class="w-full md:w-1/2 mt-4">
        @csrf
        <input type="text" name="name" class="bg-white shadow rounded p-4 text-theme-darkest mb-2 text-lg" placeholder="Your name" required>
        <input type="email" value="" name="email" class="bg-white shadow rounded p-4 text-theme-darkest mb-2 text-lg" placeholder="Your Email Address" required>
        <textarea name="message" class="bg-white shadow rounded block w-full p-4 text-theme-darkest mb-2 text-lg" rows="10" placeholder="Your message" required></textarea>
        <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_7b7724eedf18025adfda5bbcb_0343c5bea4" tabindex="-1" value=""></div>
        <button type="submit" class="bg-theme-dark text-white p-4 rounded text-lg">Send message</button>
    </div>
</form>
