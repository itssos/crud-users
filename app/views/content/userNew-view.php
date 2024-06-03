<div class="max-w-lg my-2 mx-auto px-2 md:mt-8">
    <h2 class="text-2xl my-4">Agregar nuevo usuario.</h2>
    <form class="AjaxForm" action="<?php echo APP_URL ?>app/ajax/userAjax.php" method="POST" autocomplete="off" enctype="multipart/form-data">
        <input type="hidden" name="user_action" value="register">
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <label for="name" class="block mb-2 text-sm font-medium  text-black">Nombres</label>
                <input type="text" id="name" name="name" class="bg-gray-50 border border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 text-black" placeholder="Juan" required />
            </div>
            <div>
                <label for="surname" class="block mb-2 text-sm font-medium  text-black">Apellidos</label>
                <input type="text" id="surname" name="surname" class="bg-gray-50 border border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 text-black" placeholder="Quispe Quispe" required />
            </div>
        </div>
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <label for="user" class="block mb-2 text-sm font-medium  text-black">Usuario</label>
                <input type="text" id="user" name="user" class="bg-gray-50 border border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Juancito" required />
            </div>
            <div>
                <label for="email" class="block mb-2 text-sm font-medium  text-black">Correo electrónico</label>
                <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="john.doe@company.com" required />
            </div>
        </div>
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <div class="mb-6">
                    <label for="password" class="block mb-2 text-sm font-medium  text-black">Contraseña</label>
                    <input type="password" name="password" id="password" autocomplete="on" class="bg-gray-50 border border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="•••••••••" required />
                </div>
                <div class="mb-6">
                    <label for="confirm_password" class="block mb-2 text-sm font-medium  text-black">Confirmar Contraseña</label>
                    <input type="password" id="confirm_password" name="confirm_password" autocomplete="on" class="bg-gray-50 border border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="•••••••••" required />
                </div>
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium text-black" for="photo">Seleccionar foto</label>
                <input class="block w-full mb-5 text-xs border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" id="photo" accept="image/png, image/jpeg" type="file">
                <img class="rounded-full w-20 h-20 mx-auto border border-black" src="<?php echo APP_URL?>app/views/assets/images/avatar-default.png" alt="Extra large avatar">
            </div>
        </div>
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Guardar</button>
    </form>
</div>