@extends('index')
@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-md-7">
            <h2>Contact Us</h2>
            <form>
                <div class="mb-3">
                    <label for="name" class="form-label">Your Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter your name">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Your Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter your email">
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Your Message</label>
                    <textarea class="form-control" id="message" rows="5" placeholder="Type your message"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send Message</button>
            </form>
        </div>
        <div class="col-md-5">
            <h4>Contact Information</h4>
            <ul class="list-unstyled">
                <li>
                    <strong>Address:</strong><br>
                    Lot No. 21596, Simpang Gedung, <br> Kg. Peradong Batu 6½, 71000 Kuala Klawang, <br>
                    Negeri Sembilan, MALAYSIA
                </li>
               
                <li class="mt-3">
                    <strong>Email:</strong><br>
                    info@drmind.com
                </li>
            </ul>
            <div class="mt-4">
                <iframe src="https://maps.google.com/maps?q=Lot%20No.%2021596%2C%20Simpang%20Gedung%2C%20Kg.%20Peradong%20Batu%206%C2%BD%2C%2071000%20Kuala%20Klawang%2C%20Negeri%20Sembilan%2C%20MALAYSIA&t=&z=15&ie=UTF8&iwloc=&output=embed" width="100%" height="200" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
        </div>
    </div>
</div>
@endsection