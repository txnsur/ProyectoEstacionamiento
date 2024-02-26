<!--Incluimos el header de la pagina-->
<?php include_once "components/header_2.php"; ?>

<!--Cuerpo del HTML-->
<main>
    <section class="absolute w-full h-full">
        <div class="absolute top-0 w-full h-full bg-gray-900"></div>
        <div class="container mx-auto px-4 h-full">
            <div class="flex content-center items-center justify-center h-full ">
                <div class="w-full lg:w-10/12 px-4 flex flex-row"> <!--CONTENEDOR DE LAS MEMBRESIAS-->
                    <div class="relative mr-2 ml-2 flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-gray-300 border-0">
                        <div class="flex-auto px-4 lg:px-10 py-10 pt-0 mt-5">
                            <div class="text-center mt-6">
                                <h1 class="text-lg font-bold">Titulo</h1>
                                <p class="mt-2 mb-2">Descripcion</p>
                                <button onclick="my_modal_1.showModal()" class="btn bg-gray-900 text-white active:bg-gray-700 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full" type="button" style="transition: all 0.15s ease 0s;">
                                    Comprar
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="relative mr-2 ml-2 flex flex-row min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-gray-300 border-0">
                        <div class="flex-auto px-4 lg:px-10 py-10 pt-0 mt-5">
                            <div class="text-center mt-6">
                                <h1 class="text-lg font-bold">Titulo</h1>
                                <p class="mt-2 mb-2">Descripcion</p>
                                <button onclick="my_modal_1.showModal()" class="btn bg-gray-900 text-white active:bg-gray-700 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full" type="button" style="transition: all 0.15s ease 0s;">
                                    Comprar
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="relative mr-2 ml-2 flex flex-row min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-gray-300 border-0">
                        <div class="flex-auto px-4 lg:px-10 py-10 pt-0 mt-5">
                            <div class="text-center mt-6">
                                <h1 class="text-lg font-bold">Titulo</h1>
                                <p class="mt-2 mb-2">Descripcion</p>
                                <button onclick="my_modal_1.showModal()" class="btn bg-gray-900 text-white active:bg-gray-700 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full" type="button" style="transition: all 0.15s ease 0s;">
                                    Comprar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-white absolute buttom-5 left-5 mb-20">
            <a href="registerCompany.php">Volver atras</a>
            </div>
        </div>


   
        <!--Inclumos los modales-->
        <?php include_once "components/modals.php"; ?>

        <!--Inclumos los footers de los logins-->
        <?php include_once "components/footer_2.php"; ?>