<div class="min-h-screen flex flex-col items-center justify-center bg-gradient-to-b from-gray-700 to-gray-900">
  <div class="flex flex-col shadow-md px-6 md:px-8 lg:px-10 py-8 rounded-md w-full max-w-md">
    <div class="font-medium self-center text-2xl text-white">INGRESE A SU CUENTA</div>
    <div class="mt-10">
      <form action="" class="">
        <div class="flex flex-col mb-6">
          <label for="username" class="mb-1 text-sm tracking-wide text-white">User:</label>
          <div class="relative">
            <div class="inline-flex items-center justify-center absolute left-0 top-0 h-full w-10 text-gray-400">
              <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
              </svg>
            </div>

            <input id="username" type="text" name="username" class="text-base placeholder-gray-500 pl-10 pr-4 rounded-lg border border-gray-400 w-full py-2 focus:outline-none focus:border-blue-400" placeholder="Username" />
          </div>
        </div>
        <div class="flex flex-col mb-6">
          <label for="password" class="mb-1 tracking-wide text-white">Password:</label>
          <div class="relative">
            <div class="inline-flex items-center justify-center absolute left-0 top-0 h-full w-10 text-gray-400">
              <span>
                <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                  <path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
              </span>
            </div>

            <input id="password" type="password" name="password" autocomplete="on" class="text-base placeholder-gray-500 pl-10 pr-4 rounded-lg border border-gray-400 w-full py-2 focus:outline-none focus:border-blue-400" placeholder="Password" />
          </div>
        </div>

        <div class="flex items-center mb-6 -mt-4">
          <div class="flex ml-auto">
            <a href="#" class="inline-flex text-sm text-blue-400 hover:text-blue-500">¿Olvidaste tu contraseña?</a>
          </div>
        </div>

        <div class="flex">
          <button type="submit" class="w-full flex items-center justify-center text-sm bg-slate-950 text-slate-400 border-2 border-slate-400  font-medium overflow-hidden relative px-4 py-2 rounded-md hover:brightness-150 active:opacity-75 outline-none duration-150 group">
            <span class="mr-2 uppercase">Login</span>
            <span>
              <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </span>
            <span class="bg-slate-400 shadow-slate-400 absolute -top-[150%] left-0 inline-flex w-full h-[10px] rounded-md opacity-30 group-hover:top-[150%] duration-500 shadow-[0_0_10px_10px_rgba(0,0,0,1)]"></span>
          </button>
        </div>
      </form>
    </div>
    <!-- <div class="flex justify-center items-center mt-6">
      <a href="#" target="_blank" class="inline-flex items-center font-bold text-blue-500 hover:text-blue-700 text-xs text-center">
        <span>
          <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
            <path d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
          </svg>
        </span>
        <span class="ml-2">You don't have an account?</span>
      </a>
    </div> -->
  </div>
</div>