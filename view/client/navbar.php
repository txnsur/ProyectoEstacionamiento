<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#000000" />
  <link rel="stylesheet" href="../../css/output.css">
  <title>Dashboard | Parking Manager</title>

</head>

<body class="text-blueGray-700 antialiased">
  <noscript>You need to enable JavaScript to run this app.</noscript>
  <div id="root">

    <nav class="md:left-0 md:block md:fixed md:top-0 md:bottom-0 md:overflow-y-auto md:flex-row md:flex-nowrap md:overflow-hidden shadow-xl bg-white flex flex-wrap items-center justify-between relative md:w-64 z-10 py-4 px-6">
      <div class="md:flex-col md:items-stretch md:min-h-full md:flex-nowrap px-0 flex flex-wrap items-center justify-between w-full mx-auto">
        <button class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent" type="button" onclick="toggleNavbar('example-collapse-sidebar')">
          <i class="fas fa-bars"></i></button>
        <a class="md:block text-left md:pb-2 text-blueGray-600 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0" href="javascript:void(0)">
          Parking Manager
        </a>

        <div class="md:flex md:flex-col md:items-stretch md:opacity-100 md:relative md:mt-4 md:shadow-none shadow absolute top-0 left-0 right-0 z-40 overflow-y-auto overflow-x-hidden h-auto items-center flex-1 rounded hidden" id="example-collapse-sidebar">
          <ul class="md:flex-col md:min-w-full flex flex-col list-none">
            <li class="items-center hover:bg-gray-100">
              <a class=" text-pink-500 hover:text-pink-600 text-xs uppercase py-3 font-bold block" href="#/dashboard"><i class="fas fa-tv opacity-75 mr-2 text-sm"></i>
                Dashboard</a>
            </li>
            <li class="items-center hover:bg-gray-100">
              <a href="parking.php" class="hover:text-pink-600 text-blueGray-700 hover:text-blueGray-500 text-xs uppercase py-3 font-bold block" ><i class="fas fa-newspaper text-blueGray-400 mr-2 text-sm"></i>
                Parking</a>
            </li>
            <li class="items-center hover:bg-gray-100">
              <a class="hover:text-pink-600 text-blueGray-700 hover:text-blueGray-500 text-xs uppercase py-3 font-bold block" href="#/profile"><i class="fas fa-user-circle text-blueGray-400 mr-2 text-sm"></i>
                Carros</a>
            </li>
            <li class="items-center hover:bg-gray-100">
              <a class="hover:text-pink-600 text-blueGray-700 hover:text-blueGray-500 text-xs uppercase py-3 font-bold block" href="#/login"><i class="fas fa-fingerprint text-blueGray-400 mr-2 text-sm"></i>
                Empleados</a>
            </li>
            <li class="items-center hover:bg-gray-100">
              <a class="hover:text-pink-600 text-blueGray-700 hover:text-blueGray-500 text-xs uppercase py-3 font-bold block" href="#/login"><i class="fas fa-fingerprint text-blueGray-400 mr-2 text-sm"></i>
                Empleados</a>
            </li>
            <li class="items-center hover:bg-gray-100">
              <a class="hover:text-pink-600 text-blueGray-700 hover:text-blueGray-500 text-xs uppercase py-3 font-bold block" href="#/login"><i class="fas fa-fingerprint text-blueGray-400 mr-2 text-sm"></i>
                Tarjetas</a>
            </li>
            <li class="items-center hover:bg-gray-100">
              <a class="hover:text-pink-600 text-blueGray-700 hover:text-blueGray-500 text-xs uppercase py-3 font-bold block" href="#/login"><i class="fas fa-fingerprint text-blueGray-400 mr-2 text-sm"></i>
                Visitantes</a>
            </li>
            <li class="items-center hover:bg-gray-100">
              <a class="hover:text-pink-600 text-blueGray-700 hover:text-blueGray-500 text-xs uppercase py-3 font-bold block" href="#/login"><i class="fas fa-fingerprint text-blueGray-400 mr-2 text-sm"></i>
                Historial</a>
            </li>
          </ul>
          <hr class="my-4 md:min-w-full" />
          <h6 class="md:min-w-full text-blueGray-500 text-xs uppercase font-bold block pt-1 pb-4 no-underline">
            Settings
          </h6>
          <ul class="md:flex-col md:min-w-full flex flex-col list-none md:mb-4">
            <li class="items-center hover:bg-gray-100">
              <a class="hover:text-pink-600 text-blueGray-700 hover:text-blueGray-500 text-sm block mb-4 no-underline font-semibold" href="#/documentation/styles"><i class="fas fa-paint-brush mr-2 text-blueGray-400 text-base"></i>
                Configuracion</a>
            </li>
            <li class="items-center hover:bg-gray-100">
            <?php include_once "../components/modals.php";?>
              <button onclick="cerrarSesion()" class="hover:text-pink-600 text-blueGray-700 hover:text-blueGray-500 text-sm block mb-4 no-underline font-semibold"><i class="fas fa-paint-brush mr-2 text-blueGray-400 text-base"></i>
                Logout</button>
            </li>
          </ul>
        </div>
      </div>
    </nav>


    <div class="relative md:ml-64 bg-blueGray-50">
      <nav class="absolute top-0 left-0 w-full z-10 bg-transparent md:flex-row md:flex-nowrap md:justify-start flex items-center p-4">
        <div class="w-full mx-autp items-center flex justify-between md:flex-nowrap flex-wrap md:px-10 px-4">
          <a class="text-white text-sm uppercase hidden lg:inline-block font-semibold" href="dashboard.php">Dashboard</a>
          <form class="md:flex hidden flex-row flex-wrap items-center lg:ml-auto mr-3">
            <div class="relative flex w-full flex-wrap items-stretch">
              <span class="z-10 h-full leading-snug font-normal absolute text-center text-blueGray-300 absolute bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3"><i class="fas fa-search"></i></span>
              <input type="text" placeholder="Search here..." class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:ring w-full pl-10" />
            </div>
          </form>
          <ul class="flex-col md:flex-row list-none items-center hidden md:flex">
            <a class="text-blueGray-500 block" href="#pablo" onclick="openDropdown(event,'user-dropdown')">
              <div class="items-center flex">
                <span class="w-12 h-12 text-sm text-white bg-blueGray-200 inline-flex items-center justify-center rounded-full"><img alt="..." class="w-full rounded-full align-middle border-none shadow-lg" src="./assets/img/team-1-800x800.jpg" /></span>
              </div>
            </a>
            <div class="hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg mt-1" style="min-width: 12rem;" id="user-dropdown">
              <a href="#pablo" class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">Action</a><a href="#pablo" class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">Another action</a><a href="#pablo" class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">Something else here</a>
              <div class="h-0 my-2 border border-solid border-blueGray-100"></div>
              <a href="#pablo" class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">Seprated link</a>
            </div>
          </ul>
        </div>
      </nav>
