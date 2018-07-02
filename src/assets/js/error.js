const previousPageBtn = $('#go-back');

previousPageBtn.click(() => {
  history.go(-1);

});