@if(session()->has('contact_success'))
    <div class="bg-theme-dark text-white p-4 rounded">
        {{__('contact.confirmation')}}
    </div>
@endif
