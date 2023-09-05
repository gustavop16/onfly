import axios from 'axios';
import { JWTResponseInterceptor } from '../../interceptors/jwt-response.interceptor';

const api = axios.create({
  baseURL: 'http://localhost:8000/api',
});

api.interceptors.response.use(
  JWTResponseInterceptor.success,
  JWTResponseInterceptor.error,
  JWTResponseInterceptor.options
);
export { api };
