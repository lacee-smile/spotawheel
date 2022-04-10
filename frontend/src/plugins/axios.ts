"use strict";

import axios from "axios";

const config = {
  baseURL: 'http://localhost:8000/api'
};

const _axios = axios.create(config);

export default _axios;
