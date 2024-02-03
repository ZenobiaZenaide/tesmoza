import './bootstrap.js';
import 'boxicons';
// export {{ toggleFilter }};

// Kebutuhan Fungsi Di Web Dashboard
//Menyimpan Variable di Dashboard
// var selectedStatuses = [];
// var dummyData = []; // You can initialize it with actual data from your server or include it directly

// function toggleFilter(status) {
//     if (selectedStatuses.includes(status)) {
//         selectedStatuses = selectedStatuses.filter(item => item !== status);
//     } else {
//         selectedStatuses.push(status);
//     }

//     console.log('Selected Statuses:', selectedStatuses);
//     filterData(selectedStatuses);
// }

// function filterData(statuses) {
//     const filteredData = dummyData.filter(data => statuses.includes(data.status));
//     updateUI(filteredData);
// }

// function updateUI(data) {
//     const tableBody = document.querySelector('.fallout-table tbody');
//     tableBody.innerHTML = '';

//     data.forEach(function(item) {
//         const row = document.createElement('tr');
//         row.innerHTML = `<td>${item.order_id}</td>
//                          <td>${item.sto}</td>
//                          <td>${item.tanggal_fallout}</td>
//                          <td>${item.pic}</td>
//                          <td>${item.status}</td>
//                          <td>${item.ket}</td>`;

//         tableBody.appendChild(row);
//     });
// }