/*!
* Start Bootstrap - Simple Sidebar v6.0.6 (https://startbootstrap.com/template/simple-sidebar)
* Copyright 2013-2023 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-simple-sidebar/blob/master/LICENSE)
*/
// 
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});

$('.form').find('input, textarea').on('keyup blur focus', function (e) {
  
    var $this = $(this),
        label = $this.prev('label');
  
        if (e.type === 'keyup') {
              if ($this.val() === '') {
            label.removeClass('active highlight');
          } else {
            label.addClass('active highlight');
          }
      } else if (e.type === 'blur') {
          if( $this.val() === '' ) {
              label.removeClass('active highlight'); 
              } else {
              label.removeClass('highlight');   
              }   
      } else if (e.type === 'focus') {
        
        if( $this.val() === '' ) {
              label.removeClass('highlight'); 
              } 
        else if( $this.val() !== '' ) {
              label.addClass('highlight');
              }
      }
  
  });
  
  $('.tab a').on('click', function (e) {
    
    e.preventDefault();
    
    $(this).parent().addClass('active');
    $(this).parent().siblings().removeClass('active');
    
    target = $(this).attr('href');
  
    $('.tab-content > div').not(target).hide();
    
    $(target).fadeIn(600);
    
  });

  var skip = 0; // Variabel untuk melacak jumlah data yang sudah ditampilkan

function loadMoreData() {
    // Kirim permintaan AJAX ke load_more_data.php dengan parameter skip
    $.ajax({
        url: 'load_more_data.php?skip=' + skip,
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            // Tambahkan data yang diterima ke dalam tabel
            $('table').append(response.output);

            // Perbarui variabel skip
            skip += <?php echo $limit; ?>;

            // Periksa apakah masih ada data yang tersisa
            if (response.hasMore) {
                // Tampilkan tombol "Load More"
                $('#loadMoreBtn').show();
            } else {
                // Sembunyikan tombol "Load More" jika tidak ada data yang tersisa
                $('#loadMoreBtn').hide();
            }
        },
        error: function(xhr, status, error) {
            console.log(error); // Tampilkan pesan kesalahan jika terjadi masalah
        }
    });
}

$(document).ready(function() {
    loadMoreData(); // Panggil fungsi untuk memuat data awal

    $('#loadMoreBtn').click(function() {
        loadMoreData(); // Panggil fungsi saat tombol "Load More" diklik
    });
});
