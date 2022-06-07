<style>
    @media only screen and (max-width: 600px) {
        .sayeddrop {
            display: block;
        }
    }

    @media only screen and (min-width: 600px) {
        .sayeddrop {
            display: none;
        }
    }
</style>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg  blur blur-rounded top-0  z-index-3 shadow position-absolute my-2 start-0 end-0 mx-4">
    <div class="container-fluid px-0">
    <a class="navbar-brand font-weight-bolder ms-sm-3" href="#" rel="tooltip" title="Developed by SK SAYED AKTAR" data-placement="bottom" target="_blank" style="border-radius: 60px;">
        <img src="./assets/img/favicon.ico" width="40" height="40" style="border: 2px solid black; border-radius: 50px;"/>
        Smart Network
    </a>

    <!-- Dropdown -->
    <div class="dropdown sayeddrop">
        <button class="btn bg-gradient-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
            Menu
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <li><a class="dropdown-item" href="./index.php">Home</a></li>
            <li><a class="dropdown-item" href="https://blog.smartnetwork.org.in/">Blog</a></li>
           <!--- <li><a class="dropdown-item" href="javascript:;">Achivement</a></li>--->
            <li><a class="dropdown-item" href="mailto:off.smartnetwork@gmail.com">Contact Us</a></li>
            <li><a class="dropdown-item" href="./sign-in.php">Sign In</a></li>
            <li><a class="dropdown-item" href="./ecomsn/index.html">Shop</a></li>
        </ul>
    </div>
    <!-- Dropdown -->


    <div class="collapse navbar-collapse pt-3 pb-2 py-lg-0 w-100" id="navigation">
        <ul class="navbar-nav navbar-nav-hover ms-lg-12 ps-lg-4 w-100">
        <li class="nav-item my-auto ms-3 ms-lg-0">
            <a href="./index.php" class="btn btn-sm bg-gradient-dark btn-round mb-0 me-1 mt-2 mt-md-0">Home</a>
        </li>
         <li class="nav-item my-auto ms-3 ms-lg-0">
            <a href="https://blog.smartnetwork.org.in/" class="btn btn-sm bg-gradient-dark btn-round mb-0 me-1 mt-2 mt-md-0">Blog</a>
        </li>
        
       <!--- <li class="nav-item my-auto ms-3 ms-lg-0">
            <a href="#" class="btn btn-sm bg-gradient-dark btn-round mb-0 me-1 mt-2 mt-md-0">Achivement</a>
        </li>--->

        <li class="nav-item my-auto ms-3 ms-lg-0">
            <a href="mailto:"off.smartnetwork@gmail.com" class="btn btn-sm bg-gradient-dark btn-round mb-0 me-1 mt-2 mt-md-0">Contact us</a>
        </li>

        <li class="nav-item my-auto ms-3 ms-lg-0">
            <a href="./sign-in.php" class="btn btn-sm  bg-gradient-primary  btn-round mb-0 me-1 mt-2 mt-md-0">Sign In</a>
        </li>
        <li class="nav-item my-auto ms-3 ms-lg-0">
            <a href= "./ecomsn/index.html" class="btn btn-sm bg-gradient-dark btn-round mb-0 me-1 mt-2 mt-md-0">Shop</a>
        </li>
        </ul>
    </div>
    </div>
</nav>
<!-- End Navbar -->