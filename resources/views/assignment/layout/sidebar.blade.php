 <!-- SIDEBAR -->
 <section id="sidebar">
    <a href="#" class="brand">
        <i class='bx bxs-smile  bx-lg'></i>
        <span class="text">Assignment</span>
    </a>
    <ul class="side-menu top">
        <li class="active" onclick="demo(this)" id="first">
            <a href="#">
                <i class='bx bxs-dashboard bx-sm'></i>
                <span class="text">Assignment 1</span>
            </a>
        </li>
        <li onclick="demo(this)" id="second">
            <a href="#">
                <i class='bx bxs-dashboard bx-sm'></i>
                <span class="text">Assignment 2</span>
            </a>
        </li>
        <li onclick="demo(this)" id="third">
            <a href="#">
                <i class='bx bxs-dashboard bx-sm'></i>
                <span class="text">Assignment 3</span>
            </a>
        </li>
    </ul>

    <ul class="side-menu bottom">
        <li>
            <a href="{{route('logout')}}" class="logout">
                <i class='bx bx-power-off bx-sm bx-burst-hover'></i>
                <span class="text">Logout</span>
            </a>
        </li>
    </ul>
</section>
<!-- SIDEBAR -->
