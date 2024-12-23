<div class="flex flex-wrap mt-6 -mx-3">
    <div class="w-full max-w-full px-3 mt-0 lg:w-7/12 lg:flex-none">
        <div class="border-black/12.5 dark:bg-slate-850 dark:shadow-dark-xl shadow-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
            <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid p-6 pt-4 pb-0 flex justify-between">
                <h6 class="capitalize dark:text-white">Overview</h6>
                <!-- <select id="ctype">
                    <option value="line" selected>Line</option>
                    <option value="bar" >Bar</option>
                    <option value="polarArea" >Polar Area</option>
                    <option value="radar" >Radar</option>
                </select> -->
            </div>
            <div class="flex-auto p-4">
                <div>
                    <canvas id="chart-line" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>




    <div class="w-full max-w-full px-3 mt-0 lg:w-5/12 lg:flex-none">
        <div class="border-black/12.5 h shadow-xl dark:bg-slate-850 dark:shadow-dark-xl relative flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
            <div class="p-4 pb-0 rounded-t-4 flex justify-between">
                <h6 class="mb-0 dark:text-white">Categories</h6>
                <div class="mb-0 dark:text-white dark:opacity-60 flex">
                    <button id="category" class="inline-block px-6 py-3 mb-0 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer hover:scale-102 active:opacity-85 hover:shadow-xs bg-gradient-to-tl from-blue-500 to-violet-500 leading-pro ease-in tracking-tight-rem shadow-md bg-150 bg-x-25">
                        Add
                    </button>
                </div>
            </div>
            <div class="flex-auto p-4">
                <ul id="categories-list" class="flex flex-col pl-0 mb-0 rounded-lg">
                    <!-- Categories will be appended here -->
                </ul>
            </div>
        </div>
    </div>
</div>



<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Fetch and display categories on page load
        fetchCategories();

        // Add category button click event
        document.getElementById('category').addEventListener('click', () => {
            Swal.fire({
                title: 'Add Category',
                html: `
                    <form id="addCategoryForm">
                        <!-- Name Field -->
                        <div class="form-row">
                            <label for="name">Name:</label>
                            <input type="text" id="swal-name" name="name" class="" required placeholder="Enter category name">
                        </div>

                        <!-- Type Field -->
                        <div class="form-row">
                            <label for="type">Type:</label>
                            <select id="swal-type" name="type" class="swal2-input" required>
                                <option value="" selected disabled>Select Type</option>
                                <option value="income">Income</option>
                                <option value="expense">Expense</option>
                            </select>
                        </div>
                    </form>
                `,
                confirmButtonText: 'Submit',
                confirmButtonColor: 'green',
                preConfirm: () => {
                    const name = document.getElementById('swal-name').value.trim();
                    const type = document.getElementById('swal-type').value;

                    if (!name || !type) {
                        Swal.showValidationMessage('Please fill out all fields and select a type');
                        return false;
                    }

                    return { name, type };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const { name, type } = result.value;

                    // Send data to backend using Axios
                    axios.post('/create-category', { name, type }) // Replace with your API endpoint
                        .then(response => {
                            // Show success message
                            Swal.fire({
                                title: 'Success!',
                                text: `${type.charAt(0).toUpperCase() + type.slice(1)} category added successfully.`,
                                icon: 'success',
                                confirmButtonText: 'OK',
                                confirmButtonColor: 'blue',
                            });

                            // Refresh categories list
                            fetchCategories();
                        })
                        .catch(error => {
                            // Show error message
                            Swal.fire({
                                title: 'Error',
                                text: 'Failed to add category. Please try again later.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                            console.error('Error:', error);
                        });
                }
            });
        });
    });

    // Function to fetch and display categories
    async function fetchCategories() {
        try {
            const response = await axios.get('/list-category'); // Replace with your API endpoint
            const result = response.data;

            if (result.status === 'success') {
                const categoriesList = document.getElementById('categories-list');
                categoriesList.innerHTML = ''; // Clear existing categories

                result.data.forEach((category) => {
                    const li = document.createElement('li');
                    li.className = 'relative flex justify-between py-2 pr-4 mb-2 border-0 rounded-t-lg rounded-xl text-inherit';
                    li.innerHTML = `
                        <div class="flex items-center">
                            <div class="inline-block w-8 h-8 mr-4 text-center text-black bg-center shadow-sm fill-current stroke-none bg-gradient-to-tl from-zinc-800 to-zinc-700 dark:bg-gradient-to-tl dark:from-slate-750 dark:to-gray-850 rounded-xl">
                                <i class="text-white ni ni-mobile-button relative top-0.75 text-xxs"></i>
                            </div>
                            <div class="flex flex-col">
                                <h6 class="mb-1 text-sm leading-normal text-slate-700 dark:text-white">${category.name}</h6>
                                <span class="text-xs leading-tight dark:text-white/80">${category.type.charAt(0).toUpperCase() + category.type.slice(1)}</span>
                            </div>
                        </div>
                    `;
                    categoriesList.appendChild(li);
                });
            } else {
                console.error('Failed to fetch categories:', result);
                Swal.fire('Error', 'Failed to fetch categories.', 'error');
            }
        } catch (error) {
            console.error('Error fetching categories:', error);
            Swal.fire('Error', 'Failed to fetch categories.', 'error');
        }
    }
</script>






<script>
    if (document.querySelector("#chart-line")) {
        const ctx1 = document.getElementById("chart-line").getContext("2d");
        // const ctype = document.getElementById("ctype").value

        // Create gradients for income and expense
        const gradientStrokeIncome = ctx1.createLinearGradient(0, 230, 0, 50);
        gradientStrokeIncome.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
        gradientStrokeIncome.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
        gradientStrokeIncome.addColorStop(0, 'rgba(94, 114, 228, 0)');

        const gradientStrokeExpense = ctx1.createLinearGradient(0, 230, 0, 50);
        gradientStrokeExpense.addColorStop(1, 'rgba(255, 99, 132, 0.2)');
        gradientStrokeExpense.addColorStop(0.2, 'rgba(255, 99, 132, 0.0)');
        gradientStrokeExpense.addColorStop(0, 'rgba(255, 99, 132, 0)');

        const chart = new Chart(ctx1, {
            type: "line",
            data: {
                labels: [],
                datasets: [{
                        label: "Income",
                        borderColor: "#5e72e4",
                        backgroundColor: gradientStrokeIncome,
                        borderWidth: 3,
                        fill: true,
                        data: [],
                    },
                    {
                        label: "Expense",
                        borderColor: "#FF6347",
                        backgroundColor: gradientStrokeExpense,
                        borderWidth: 3,
                        fill: true,
                        data: [],
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true
                    },
                },
                scales: {
                    y: {
                        ticks: {
                            callback: function(value) {
                                return '$' + value.toFixed(2);
                            },
                        },
                    },
                    x: {
                        ticks: {
                            display: true
                        },
                    },
                },
            },
        });

        // Fetch data for income and expenses
        Promise.all([fetch('/get-income'), fetch('/get-expense')])
            .then(async ([incomeRes, expenseRes]) => {
                const incomeData = await incomeRes.json();
                const expenseData = await expenseRes.json();

                if (incomeData.ststus === 'success' && expenseData.ststus === 'success') {
                    const combinedDates = [...new Set([
                        ...incomeData.incomes.map(inc => inc.date),
                        ...expenseData.expense.map(exp => exp.date),
                    ])].sort();

                    chart.data.labels = combinedDates;

                    chart.data.datasets[0].data = combinedDates.map(date => {
                        const income = incomeData.incomes.find(inc => inc.date === date);
                        return income ? parseFloat(income.amount) : 0;
                    });

                    chart.data.datasets[1].data = combinedDates.map(date => {
                        const expense = expenseData.expense.find(exp => exp.date === date);
                        return expense ? parseFloat(expense.amount) : 0;
                    });

                    chart.update();
                } else {
                    console.error("Invalid API response.");
                }
            })
            .catch(error => {
                console.error("Error fetching data:", error);
            });
    }
</script>
