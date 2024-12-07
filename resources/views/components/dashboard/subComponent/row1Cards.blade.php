<div class="flex flex-wrap -mx-3">
    <!-- card1 -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">Balance</p>
                            <h5 class="mb-2 font-bold dark:text-white">$<span id="blance"></span></h5>
                            <div class="mb-0 dark:text-white dark:opacity-60 flex">
                                <button id="addIncome" class="inline-block px-6 py-3 mb-0 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer hover:scale-102 active:opacity-85 hover:shadow-xs bg-gradient-to-tl from-blue-500 to-violet-500 leading-pro ease-in tracking-tight-rem shadow-md bg-150 bg-x-25 ">Add</button></span>
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
        let blance = document.querySelector('#blance')
        fetch('/showBalance')
            .then(response => response.json())
            .then(data => {
                blance.innerText = data['balance'];
            })


        document.getElementById('addIncome').addEventListener('click', () => {
            // Fetch categories from the API
            fetch('/list-category') // Replace with your actual API endpoint
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to fetch categories. Status: ' + response.status);
                    }
                    return response.json();
                })
                .then(data => {
                    // Get categories and filter for income type
                    const categories = data.categories || data.data || [];
                    const incomeCategories = categories.filter(category => category.type === 'income');

                    if (incomeCategories.length > 0) {
                        // Generate options for the select dropdown
                        const options = incomeCategories
                            .map(category => `<option value="${category.id}">${category.name}</option>`)
                            .join('');

                        // Display SweetAlert with dynamic income categories
                        Swal.fire({
                            title: 'Add Income',
                            html: `
                            <form id="incomeForm">
                                <div class="form-row">
                                    <label for="amount">Amount:</label>
                                    <input type="tel" id="swal-amount" name="amount" required placeholder="Enter your amount">
                                </div>
                                <div class="form-row">
                                    <label for="category">Category:</label>
                                    <select id="swal-category" name="category" required>
                                        <option value="">Select a category</option>
                                        ${options}
                                    </select>
                                </div>
                                <div class="form-row">
                                    <label for="date">Date:</label>
                                    <input type="date" id="swal-date" name="date" required>
                                </div>
                            </form>
                        `,
                            confirmButtonText: 'Submit',
                            confirmButtonColor: 'green',
                            preConfirm: () => {
                                const amount = document.getElementById('swal-amount').value.trim();
                                const category = document.getElementById('swal-category').value;
                                const date = document.getElementById('swal-date').value;

                                if (!amount || !category || !date) {
                                    Swal.showValidationMessage('Please fill out all fields');
                                    return null;
                                }

                                return {
                                    amount,
                                    category,
                                    date
                                };
                            }
                        }).then(result => {
                            if (result.isConfirmed) {
                                const {
                                    amount,
                                    category,
                                    date
                                } = result.value;

                                // Send data to the backend
                                axios.post('/add-income', {
                                        amount,
                                        category_id: category,
                                        date,
                                    })
                                    .then(response => {
                                        Swal.fire({
                                            title: 'Success!',
                                            text: 'Income details added successfully.',
                                            icon: 'success',
                                            confirmButtonColor: 'blue',
                                        }).then(() => location.reload());
                                    })
                                    .catch(error => {
                                        Swal.fire({
                                            title: 'Error',
                                            text: 'Failed to add income details. Please try again later.',
                                            icon: 'error',
                                            confirmButtonColor: 'red',
                                        });
                                        console.error('Error:', error);
                                    });
                            }
                        });
                    } else {
                        Swal.fire('Error', 'No income categories available.', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error fetching categories:', error);
                    Swal.fire('Error', 'Failed to fetch categories.', 'error');
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
                            <h5 class="mb-2 font-bold dark:text-white">$ <span class="text-red-500" id="expanse"></span></h5>
                            <div class="mb-0 dark:text-white dark:opacity-60 flex">
                                <button id="addExpanse" class="inline-block px-6 py-3 mb-0 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer hover:scale-102 active:opacity-85 hover:shadow-xs bg-gradient-to-tl from-blue-500 to-violet-500 leading-pro ease-in tracking-tight-rem shadow-md bg-150 bg-x-25 ">Add</button></span>
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
        let expanse = document.querySelector('#expanse');
        fetch('/get-sum-expense')
            .then(response => response.json())
            .then(data => {
                expanse.innerText = data['expense'];
            });

        document.getElementById('addExpanse').addEventListener('click', () => {
            // Fetch categories from the API
            fetch('/list-category') // Replace with your actual API endpoint
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // Ensure the categories structure matches your backend response
                    const categories = data.categories || data.data || data;

                    if (categories && categories.length > 0) {
                        // Filter categories to include only those with type 'expense'
                        const expenseCategories = categories.filter(category => category.type === 'expense');

                        if (expenseCategories.length > 0) {
                            // Generate options dynamically for expense categories
                            const options = expenseCategories
                                .map(category => `<option value="${category.id}">${category.name}</option>`)
                                .join('');

                            // Show SweetAlert popup with dynamic expense categories
                            Swal.fire({
                                title: 'Add Expense',
                                html: `
                            <form id="myForm">
                                <!-- Name Field -->
                                <div class="form-row">
                                    <label for="name">Name:</label>
                                    <input type="tel" id="swal-name" name="name" required placeholder="Enter your Expense Name">
                                </div>

                                <!-- Amount Field -->
                                <div class="form-row">
                                    <label for="name">Amount:</label>
                                    <input type="tel" id="swal-amount" name="amount" required placeholder="Enter your amount">
                                </div>

                                <!-- Category Field -->
                                <div class="form-row">
                                    <label for="category">Category:</label>
                                    <select name="category" id="swal-category" required>
                                        <option value="">Select a category</option>
                                        ${options}
                                    </select>
                                </div>

                                <!-- Date Field -->
                                <div class="form-row">
                                    <label for="date">Date:</label>
                                    <input type="date" id="swal-date" name="date" required placeholder="Enter Date">
                                </div>
                            </form>
                        `,
                                confirmButtonText: 'Submit',
                                confirmButtonColor: 'green',
                                preConfirm: () => {
                                    const name = document.getElementById('swal-name').value;
                                    const amount = document.getElementById('swal-amount').value;
                                    const category = document.getElementById('swal-category').value;
                                    const date = document.getElementById('swal-date').value;

                                    if (!name||!amount || !category || !date) {
                                        Swal.showValidationMessage('Please fill out all fields');
                                        return false;
                                    }

                                    return {
                                        name,
                                        amount,
                                        category,
                                        date
                                    };
                                }
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    const {
                                        name,
                                        amount,
                                        category,
                                        date
                                    } = result.value;

                                    // Send data to backend using Axios
                                    axios.post('/add-expense', { // Replace with your actual endpoint
                                            name,
                                            amount,
                                            category_id: category,
                                            date,
                                        })
                                        .then(response => {
                                            // Show a success popup after data is successfully submitted
                                            Swal.fire({
                                                title: 'Success!',
                                                text: 'Your expense details have been added successfully.',
                                                icon: 'success',
                                                confirmButtonText: 'OK',
                                                confirmButtonColor: 'blue',
                                            }).then(() => {
                                                // Reload the page after success
                                                location.reload();
                                            });
                                        })
                                        .catch(error => {
                                            // Handle error
                                            Swal.fire({
                                                title: 'Error',
                                                text: 'Failed to add expense details. Please try again later.',
                                                icon: 'error',
                                                confirmButtonText: 'OK',
                                                confirmButtonColor: 'red',
                                            });
                                            console.error('Error:', error);
                                        });
                                }
                            });
                        } else {
                            // If no expense categories are found
                            Swal.fire('Error', 'No expense categories available.', 'error');
                        }
                    } else {
                        Swal.fire('Error', 'No categories available.', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error fetching categories:', error);
                    Swal.fire('Error', 'Failed to fetch categories.', 'error');
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
                                <button id="servings" class="inline-block px-6 py-3 mb-0 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer hover:scale-102 active:opacity-85 hover:shadow-xs bg-gradient-to-tl from-blue-500 to-violet-500 leading-pro ease-in tracking-tight-rem shadow-md bg-150 bg-x-25 ">Add</button></span>
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
        document.getElementById('servings').addEventListener('click', () => {
            // Fetch categories from the API
            fetch('/list-category') // Replace with your actual API endpoint
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // Ensure the categories structure matches your backend response
                    const categories = data.categories || data.data || data;

                    if (categories && categories.length > 0) {
                        // Generate options dynamically
                        const options = categories
                            .map(category => `<option value="${category.id}">${category.name}</option>`)
                            .join('');

                        // Show SweetAlert popup with dynamic categories
                        Swal.fire({
                            title: 'Add Sevings',
                            html: `
                        <form id="myForm">
                            <!-- Name Field -->
                            <div class="form-row">
                                <label for="name">Name:</label>
                                <input type="text" id="swal-name" name="name" required placeholder="Enter your name">
                            </div>

                            <!-- Category Field -->
                            <div class="form-row">
                                <label for="category">Category:</label>
                                <select name="category" id="swal-category" required>
                                    <option value="">Select a category</option>
                                    ${options}
                                </select>
                            </div>

                            <!-- Email Field -->
                            <div class="form-row">
                                <label for="email">Email:</label>
                                <input type="email" id="swal-email" name="email" required placeholder="Enter your email">
                            </div>

                            <!-- Message Field -->
                            <div class="form-row">
                                <label for="message">Message:</label>
                                <textarea id="swal-message" name="message" rows="4" required placeholder="Your message"></textarea>
                            </div>
                        </form>
                    `,
                            confirmButtonText: 'Submit',
                            confirmButtonColor: 'green',
                            preConfirm: () => {
                                const name = document.getElementById('swal-name').value;
                                const category = document.getElementById('swal-category').value;
                                const email = document.getElementById('swal-email').value;
                                const message = document.getElementById('swal-message').value;

                                if (!name || !category || !email || !message) {
                                    Swal.showValidationMessage('Please fill out all fields');
                                    return false;
                                }

                                return {
                                    name,
                                    category,
                                    email,
                                    message
                                };
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                const {
                                    name,
                                    category,
                                    email,
                                    message
                                } = result.value;

                                // Send data to backend using Axios
                                axios.post('/api/add-income', { // Replace with your actual endpoint
                                        name,
                                        category,
                                        email,
                                        message
                                    })
                                    .then(response => {
                                        // Show a success popup after data is successfully submitted
                                        Swal.fire({
                                            title: 'Success!',
                                            text: 'Your income details have been added successfully.',
                                            icon: 'success',
                                            confirmButtonText: 'OK'
                                        });
                                        console.log('Response:', response.data);
                                    })
                                    .catch(error => {
                                        // Handle error
                                        Swal.fire({
                                            title: 'Error',
                                            text: 'Failed to add income details. Please try again later.',
                                            icon: 'error',
                                            confirmButtonText: 'OK'
                                        });
                                        console.error('Error:', error);
                                    });
                            }
                        });
                    } else {
                        Swal.fire('Error', 'No categories available.', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error fetching categories:', error);
                    Swal.fire('Error', 'Failed to fetch categories.', 'error');
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
