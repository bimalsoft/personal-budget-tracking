<div class="w-full px-6 py-6 mx-auto">
<div class="flex flex-wrap -mx-3">

          <div class="flex-none w-full max-w-full px-3">
            <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
              <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="dark:text-white">Authors table</h6>
              </div>
              <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto">
                  <table class="items-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                    <thead class="align-bottom">
                      <tr>
                        <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Name</th>
                        <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Category</th>
                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Amount</th>
                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Date</th>
                      </tr>
                    </thead>
                    <tbody id="authors-table-body">

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>


<script>
    // Function to fetch data and populate the table
    async function fetchTransactions() {
        try {
            // Replace with your actual API endpoint
            const response = await axios.get('/get-history');
            const { status, data } = response.data;

            if (status === 'success') {
                // Sort the data in descending order by date or id
                const sortedData = data.sort((a, b) => new Date(b.date) - new Date(a.date));


                // Get the table body
                const tableBody = document.getElementById('authors-table-body');

                // Clear existing rows
                tableBody.innerHTML = '';

                // Loop through the sorted data and create rows
                sortedData.forEach(item => {
                    const colorClass = item.type === 'income' ? 'bg-green-500' : 'bg-red-500';
                    const inlineColor = item.type === 'income' ? 'background-color: #16a34a;' : 'background-color: #dc2626;';

                    const row = document.createElement('tr');

                    row.innerHTML = `
            <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
              <div class="flex px-2 py-1">
                <div class="flex flex-col justify-center">
                  <h6 class="mb-0 text-sm leading-normal dark:text-white">${item.name}</h6>
                </div>
              </div>
            </td>
            <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
              <p class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-80">${item.category}</p>
            </td>
            <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
              <span class="px-2.5 py-1.4 text-xs rounded-1.8 font-bold uppercase inline-block text-white ${colorClass}" style="${inlineColor}">
                ${item.amount}
              </span>
            </td>
            <td class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
              <span class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80 text-slate-400">${item.date}</span>
            </td>
          `;

                    // Append the row to the table body
                    tableBody.appendChild(row);
                });
            } else {
                console.error('Unexpected response status:', status);
            }
        } catch (error) {
            console.error('Error fetching transactions:', error);
        }
    }

    // Call the function when the page loads
    document.addEventListener('DOMContentLoaded', fetchTransactions);
</script>


