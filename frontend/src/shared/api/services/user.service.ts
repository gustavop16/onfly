import { AxiosResponse } from 'axios';
import { UpdateUserDTO } from '../dtos';
import { UserModel } from '../models';
import { api } from './api.service';

class UserService {
  
  findById(id: number): Promise<AxiosResponse<{ data: UserModel }>> {
    const url = `/user/${id}`;

    return api.get<{ data: UserModel }>(url);
  }

  getUserLogged(): Promise<AxiosResponse<{ data: UserModel }>> {
    const url = `/user/getUserLogged`;

    return api.get<{ data: UserModel }>(url);
  }

  update(
    id: number,
    data: UpdateUserDTO
  ): Promise<AxiosResponse<{ data: UserModel }>> {
    const url = `/user/edit/${id}`;

    return api.post<{ data: UserModel }>(url, data);
  }
}

export default new UserService();
