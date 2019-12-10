$("#nav ul li").mouseenter(function () {
  $(this).find(".navDown").slideDown(300);
});
$("#nav ul li").mouseleave(function () {
  $(".navDown").not(this).stop(true, true);
  $(this).find(".navDown").slideUp(200);
})