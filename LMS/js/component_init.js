$(document).ready(function() {
	$('#top-menu > ul').tabs({ fx: { opacity: 'toggle' } });
	$('.popup-with-form').magnificPopup({
		type: 'inline',
		preloader: false,
		focus: '#username',

		// When elemened is focused, some mobile browsers in some cases zoom in
		// It looks not nice, so we disable it:
		callbacks: {
			beforeOpen: function() {
				if($(window).width() < 700) {
					this.st.focus = false;
				} else {
					this.st.focus = '#username';
				}
			}
		}
	});
    $('.popup-modal').magnificPopup({
        type: 'inline',
        preloader: false,
        modal: false
    });
    $(document).on('click', '.popup-modal-dismiss', function (e) {
        e.preventDefault();
        $.magnificPopup.close();
    });
});