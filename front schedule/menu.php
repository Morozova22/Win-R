
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<nav class="navbar navbar-expand-lg navbar-dark fixed-top ">
    <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarCollapse"
        aria-controls="navbarCollapse"
        aria-expanded="false"
        aria-label="Toggle navigation"
    >
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto sidenav" id="navAccordion">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only ">(current)</span></a>
            </li>

            <li class="nav-item">
                <ul class="nav-second-level collapse" id="collapseSubItems2" data-parent="#navAccordion">
                    <li class="nav-item">
                        <a class="nav-link" href="#" >
                            <span class="nav-link-text">Item 2.1</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span class="nav-link-text">Item 2.2</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Item 3</a>
            </li>
            <ul class="nav-second-level collapse" id="collapseSubItems4" data-parent="#navAccordion">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <span class="nav-link-text">Item 4.1</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <span class="nav-link-text">Item 4.2</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <span class="nav-link-text">Item 4.2</span>
                    </a>
                </li>
            </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Item 5</a>
            </li>
        </ul>
    </div>
</nav>

<script>
    $(document).ready(function() {
        $('.nav-link-collapse').on('click', function() {
            $('.nav-link-collapse').not(this).removeClass('nav-link-show');
            $(this).toggleClass('nav-link-show');
        });
    });
</script>
<style>

    .nav-link:hover {
        transition: all 0.4s;
        background-color: #c8a2c8;
        color: #2e3033;
    }


    @media (min-width: 992px) {
        .sidenav {
            position: absolute;
            top: 0;
            left: 0;
            width: 120px;
            height: 100vh;
            margin-top: 0;
            color: #151515;
            background: linear-gradient(180deg, #c8a2c8, #005bea);
            box-sizing: border-box;
            border-top: 1px solid rgb(59, 56, 83);
            border-radius: 2px;
            box-shadow:  7px 7px 17px #d0d0d0,
            -7px -7px 17px #f0f0f0;
        }

        .navbar-expand-lg .sidenav {
            flex-direction: column;
        }

        .content-wrapper {
            margin-left: 200px;
        }

</style>