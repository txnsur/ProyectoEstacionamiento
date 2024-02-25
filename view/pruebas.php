<!--Incluimos el header de la pagina-->
<?php include_once "components/header_2.php"; ?>

<!-- Open the modal using ID.showModal() method -->
<main class="w-full">
    <section class="absolute w-full h-full">

        <button class="btn" onclick="my_modal_1.showModal()">open modal</button>
        <dialog id="my_modal_1" class="modal">
            <div class="modal-box">
                <h3 class="font-bold text-lg">Hello!</h3>
                <p class="py-4">Press ESC key or click the button below to close</p>
                <div class="modal-action">
                    <form method="dialog">
                        <!-- if there is a button in form, it will close the modal -->
                        <button class="btn">Close</button>
                    </form>
                </div>
            </div>
        </dialog>



        <!--Inclumos los footers de los logins-->
        <?php include_once "components/footer_2.php"; ?>