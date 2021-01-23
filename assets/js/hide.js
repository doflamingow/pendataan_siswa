/*
  nama : candra dwi cahyo
  umur : 16 tahun
  email : candradwicahyo18@gmail.com
*/

$(document).ready(function() {
  $('#eye').on('click', function() {
    $('#password').attr('type', 'text');
    $('#eye').addClass('d-none');
    $('#eye-slash').removeClass('d-none');
  });
  
  $('#eye-slash').on('click', function() {
    $('#password').attr('type', 'password');
    $('#eye-slash').addClass('d-none');
    $('#eye').removeClass('d-none');
  });
});