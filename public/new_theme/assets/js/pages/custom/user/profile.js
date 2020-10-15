"use strict";

// Class definition
var KTUserProfile = function () {
	// Base elements
	var avatar;
	var offcanvas;

	// Private functions
	var initAside = function () {
		// Mobile offcanvas for mobile mode
		offcanvas = new KTOffcanvas('kt_user_profile_aside', {
            overlay: true,
            baseClass: 'kt-app__aside',
            closeBy: 'kt_user_profile_aside_close',
            toggleBy: 'kt_subheader_mobile_toggle'
        });
	}

	var initUserForm = function() {
		avatar = new KTAvatar('kt_user_avatar');
		avatar = new KTAvatar('kt_user_avatar1');
		avatar = new KTAvatar('kt_user_avatar2');
		avatar = new KTAvatar('kt_user_avatar3');
		avatar = new KTAvatar('kt_user_avatar4');
		avatar = new KTAvatar('kt_user_avatar5');
		avatar = new KTAvatar('kt_user_avatar6');
		avatar = new KTAvatar('kt_user_avatar7');
		avatar = new KTAvatar('kt_user_avatar8');
		avatar = new KTAvatar('kt_user_avatar9');
		avatar = new KTAvatar('kt_user_avatar10');
		avatar = new KTAvatar('kt_user_avatar11');
	}

	return {
		// public functions
		init: function() {
			initAside();
			initUserForm();
		}
	};
}();

KTUtil.ready(function() {
	KTUserProfile.init();
});
