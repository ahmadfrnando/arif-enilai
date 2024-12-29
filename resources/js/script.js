// document.querySelectorAll('.menu-link').forEach(link => {
//     link.addEventListener('click', function (e) {
//         e.preventDefault();

//         // Highlight menu aktif
//         document.querySelectorAll('.menu-link').forEach(item => item.classList.remove('bg-indigo-700'));
//         this.classList.add('bg-indigo-700');

//         // Ambil URL dari atribut data-url
//         const url = this.getAttribute('data-url');

//         // Muat konten baru
//         fetch(url)
//             .then(response => {
//                 if (!response.ok) throw new Error('Network response was not ok');
//                 return response.text();
//             })
//             .then(html => {
//                 document.getElementById('main-content').innerHTML = html;
//             })
//             .catch(error => console.error('There was a problem with the fetch operation:', error));
//     });
// });

document.addEventListener('DOMContentLoaded', function() {
    const submitButtons = document.querySelectorAll('form button[type="submit"]');

    submitButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            button.disabled = true;
            button.innerText = 'Processing...';
            button.form.submit();
        });

        button.form.addEventListener('submit', function(event) {
            button.disabled = true;
            button.innerText = 'Processing...';
        });
    });

    
});