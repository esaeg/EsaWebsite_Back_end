import _ from 'lodash';
window._ = _;

/**
 * load libraries that you need here
 */

import 'bootstrap';
import $ from 'jquery'
import * as Popper from '@popperjs/core'

window.jQuery = window.$ = $
window.Popper = Popper.defaults;
import 'admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js';
import 'admin-lte/dist/js/adminlte.min.js';


/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';