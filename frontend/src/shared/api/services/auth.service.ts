import { AxiosResponse } from 'axios';
import { LoginDTO } from '../dtos';
import { LoginModel } from '../models';
import { api } from './api.service';

class AuthService {
  async login({
    email,
    password,
  }: LoginDTO): Promise<AxiosResponse<LoginModel>> {
    const url = '/auth/login';

    return api.post<LoginModel>(url, { email, password });
  }

}

export default new AuthService();
