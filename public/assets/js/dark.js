var currentTheme = localStorage.getItem('theme-mode');

if (currentTheme === null || currentTheme === 'theme-dark') {
  $('html').addClass('theme-dark');
  $('.dark').hide();
  $('.light').show();
} else {
  $('html').removeClass('theme-dark');
  localStorage.removeItem('theme-mode');
  localStorage.setItem('theme-mode','theme-light');
}

$('.dark').click(function() {
   $('html').addClass('theme-dark');
    localStorage.removeItem('theme-mode');
    localStorage.setItem('theme-mode','theme-dark');
    $(this).hide();
    $('.light').show();
});

$('.light').click(function() {
    $('html').removeClass('theme-dark');
    localStorage.removeItem('theme-mode');
    localStorage.setItem('theme-mode','theme-light');
    $(this).hide();
    $('.dark').show();
});