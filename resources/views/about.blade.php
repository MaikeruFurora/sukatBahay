@extends('layout.userLayout.app')
@section('content')
<!-- Header-->
<header class="py-5 bg-white">
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xxl-8">
                <div class="text-center my-5">
                    <h1 class="fw-bolder mb-3">THE NATIONAL BUILDING CODE OF THE PHILIPPINES and Its Revised Implementing Rules and Regulations</h1>
                    <p class="lead fw-normal text-muted mb-4">Start Bootstrap was built on the idea that quality, functional website templates and themes should be available to everyone. Use our open source, free products, or support us by purchasing one of our premium products or services.</p>
                    <a class="btn btn-primary btn-lg" href="#scroll-target">Read our story</a>
                </div>
            </div>
        </div>
    </div>
</header>
 <!-- Team members section-->
 <section class="py-5 bg-light">
    <div class="container px-5 my-5">
        <div class="text-center">
            <h2 class="fw-bolder">Our team</h2>
            <p class="lead fw-normal text-muted mb-5">Dedicated to quality and your success</p>
        </div>
        <div class="row gx-5 row-cols-1 row-cols-sm-2 row-cols-xl-4 justify-content-center">
            <div class="col mb-5 mb-5 mb-xl-0">
                <div class="text-center">
                    <img class="img-fluid rounded-circle mb-4 px-4" src="https://dummyimage.com/150x150/ced4da/6c757d" alt="..." />
                    <h5 class="fw-bolder">Ibbie Eckart</h5>
                    <div class="fst-italic text-muted">Founder &amp; CEO</div>
                </div>
            </div>
            <div class="col mb-5 mb-5 mb-xl-0">
                <div class="text-center">
                    <img class="img-fluid rounded-circle mb-4 px-4" src="https://dummyimage.com/150x150/ced4da/6c757d" alt="..." />
                    <h5 class="fw-bolder">Arden Vasek</h5>
                    <div class="fst-italic text-muted">CFO</div>
                </div>
            </div>
            <div class="col mb-5 mb-5 mb-sm-0">
                <div class="text-center">
                    <img class="img-fluid rounded-circle mb-4 px-4" src="https://dummyimage.com/150x150/ced4da/6c757d" alt="..." />
                    <h5 class="fw-bolder">Toribio Nerthus</h5>
                    <div class="fst-italic text-muted">Operations Manager</div>
                </div>
            </div>
            <div class="col mb-5">
                <div class="text-center">
                    <img class="img-fluid rounded-circle mb-4 px-4" src="https://dummyimage.com/150x150/ced4da/6c757d" alt="..." />
                    <h5 class="fw-bolder">Malvina Cilla</h5>
                    <div class="fst-italic text-muted">CTO</div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection