<div class="flex flex-wrap -mx-3">
    <!-- card1 -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">Balance</p>
                            <h5 class="mb-2 font-bold dark:text-white">$53,000</h5>
                            <div class="mb-0 dark:text-white dark:opacity-60 flex">
                                <button id="addIncome" class="inline-block px-6 py-3 mb-0 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer hover:scale-102 active:opacity-85 hover:shadow-xs bg-gradient-to-tl from-blue-500 to-violet-500 leading-pro ease-in tracking-tight-rem shadow-md bg-150 bg-x-25 " onclick="soft.showSwal('basic')">Add</button></span>
                            </div>

                        </div>
                    </div>
                    <div class="px-3 text-right basis-1/3">
                        <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-blue-500 to-violet-500">
                            <i class="ni leading-none ni-money-coins text-lg relative top-3.5 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Function to show SweetAlert login popup
        document.getElementById('addIncome').addEventListener('click', () => {
            Swal.fire({
                title: 'Add Income',
                html: `
            <!-- Form -->
       <form id="myForm" method="POST" action="submit_form.php">
            <!-- Name Field -->
            <div class="form-row">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required placeholder="Enter your name">
            </div>

            <!-- Email Field -->
            <div class="form-row">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required placeholder="Enter your email">
            </div>

            <!-- Message Field -->
            <div class="form-row">
                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="4" required placeholder="Your message"></textarea>
            </div>

            <!-- Submit Button -->
            <div class="form-row">
                <button type="submit">Submit</button>
            </div>
        </form>
                      `,
                confirmButtonText: 'Submit',
                focusConfirm: false,
                preConfirm: () => {
                    const username = document.getElementById('swal-username').value;
                    const password = document.getElementById('swal-password').value;

                    if (!username || !password) {
                        Swal.showValidationMessage('Please enter both username and password');
                    } else {
                        return { username, password };
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const { username, password } = result.value;
                    // Perform your login logic here (e.g., send data to the server)
                    Swal.fire(`Welcome, ${username}!`);
                }
            });
        });
    </script>


    <!-- card2 -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">Expanse</p>
                            <h5 class="mb-2 font-bold dark:text-white">$53,000</h5>
                            <div class="mb-0 dark:text-white dark:opacity-60 flex">
                                <button id="addExpanse" class="inline-block px-6 py-3 mb-0 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer hover:scale-102 active:opacity-85 hover:shadow-xs bg-gradient-to-tl from-blue-500 to-violet-500 leading-pro ease-in tracking-tight-rem shadow-md bg-150 bg-x-25 " onclick="soft.showSwal('basic')">Add</button></span>
                            </div>

                        </div>
                    </div>
                    <div class="px-3 text-right basis-1/3">
                        <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-blue-500 to-violet-500 ">
                            <i class="ni leading-none ni-money-coins text-lg relative top-3.5 text-white "></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Function to show SweetAlert login popup
        document.getElementById('addExpanse').addEventListener('click', () => {
            Swal.fire({
                title: 'Add Expanse',
                html: `
            <!-- Form -->
       <form id="myForm" method="POST" action="submit_form.php">
            <!-- Name Field -->
            <div class="form-row">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required placeholder="Enter your name">
            </div>

            <!-- Email Field -->
            <div class="form-row">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required placeholder="Enter your email">
            </div>

            <!-- Message Field -->
            <div class="form-row">
                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="4" required placeholder="Your message"></textarea>
            </div>

            <!-- Submit Button -->
            <div class="form-row">
                <button type="submit">Submit</button>
            </div>
        </form>
                      `,
                confirmButtonText: 'Submit',
                focusConfirm: false,
                preConfirm: () => {
                    const username = document.getElementById('swal-username').value;
                    const password = document.getElementById('swal-password').value;

                    if (!username || !password) {
                        Swal.showValidationMessage('Please enter both username and password');
                    } else {
                        return { username, password };
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const { username, password } = result.value;
                    // Perform your login logic here (e.g., send data to the server)
                    Swal.fire(`Welcome, ${username}!`);
                }
            });
        });
    </script>






    <!-- card3 -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">Servings</p>
                            <h5 class="mb-2 font-bold dark:text-white">$53,000</h5>
                            <div class="mb-0 dark:text-white dark:opacity-60 flex">
                                <button id="servings" class="inline-block px-6 py-3 mb-0 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer hover:scale-102 active:opacity-85 hover:shadow-xs bg-gradient-to-tl from-blue-500 to-violet-500 leading-pro ease-in tracking-tight-rem shadow-md bg-150 bg-x-25 " onclick="soft.showSwal('basic')">Add</button></span>
                            </div>

                        </div>
                    </div>
                    <div class="px-3 text-right basis-1/3">
                        <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-blue-500 to-violet-500">
                            <i class="ni leading-none ni-money-coins text-lg relative top-3.5 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Function to show SweetAlert login popup
        document.getElementById('servings').addEventListener('click', () => {
            Swal.fire({
                title: 'Add Servings',
                html: `
            <!-- Form -->
       <form id="myForm" method="POST" action="submit_form.php">
            <!-- Name Field -->
            <div class="form-row">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required placeholder="Enter your name">
            </div>

            <!-- Email Field -->
            <div class="form-row">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required placeholder="Enter your email">
            </div>

            <!-- Message Field -->
            <div class="form-row">
                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="4" required placeholder="Your message"></textarea>
            </div>

            <!-- Submit Button -->
            <div class="form-row">
                <button type="submit">Submit</button>
            </div>
        </form>
                      `,
                confirmButtonText: 'Submit',
                focusConfirm: false,
                preConfirm: () => {
                    const username = document.getElementById('swal-username').value;
                    const password = document.getElementById('swal-password').value;

                    if (!username || !password) {
                        Swal.showValidationMessage('Please enter both username and password');
                    } else {
                        return { username, password };
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const { username, password } = result.value;
                    // Perform your login logic here (e.g., send data to the server)
                    Swal.fire(`Welcome, ${username}!`);
                }
            });
        });
    </script>





    <!-- card4 -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">Your Gol </p>
                            <h5 class="mb-2 font-bold dark:text-white">$53,000</h5>
                            <div class="mb-0 dark:text-white dark:opacity-60 flex ">
                                <button class="inline-block px-6 py-3 mb-0 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg   bg-white leading-pro ease-in tracking-tight-rem  bg-150 bg-x-25 ">Add</button>
                            </div>

                        </div>
                    </div>
                    <div class="px-3 text-right basis-1/3">
                        <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-blue-500 to-violet-500">
                            <i class="ni leading-none ni-money-coins text-lg relative top-3.5 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


