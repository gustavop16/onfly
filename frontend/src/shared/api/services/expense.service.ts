import { AxiosResponse } from 'axios';
import { CreateExpenseDTO } from '../dtos';
import { ExpenseModel } from '../models';
import { api } from './api.service';

class ExpenseService {
  list(userId: number,): Promise<AxiosResponse<{ data: ExpenseModel[] }>> {
    const url = `/expenses/${userId}/user`;
    return api.get<{ data: ExpenseModel[] }>(url);
  }

  findById(expenseId: number): Promise<AxiosResponse<{ data: ExpenseModel }>> {
    const url = `/expenses/${expenseId}`;

    return api.get<{ data: ExpenseModel }>(url);
  }

  create(data: CreateExpenseDTO): Promise<AxiosResponse<ExpenseModel>> {
    const url = '/expenses';

    const access_token  = this.getWithExpiry("token")
    const token_type    = this.getWithExpiry("token_type")
    api.defaults.headers.common.authorization = `${token_type} ${access_token}`;

    return api.post<ExpenseModel>(url, data, {
      headers: {
        'Content-Type': 'multipart/form-data',
      },
    });
  }

  update(
    expenseId: number,
    data: CreateExpenseDTO
  ): Promise<AxiosResponse<{ data: CreateExpenseDTO }>> {
    const url = `/expenses/${expenseId}`;
    return api.put<{ data: ExpenseModel }>(url, data, {
    });
  }

  delete(expenseId: number): Promise<AxiosResponse<void>> {
    const url = `/expenses/${expenseId}`;

    return api.delete<void>(url);
  }

  getWithExpiry(key) {
    const itemStr = localStorage.getItem(key)
    // if the item doesn't exist, return null
    if (!itemStr) {
      return null
    }
    const item = JSON.parse(itemStr)
    const now = new Date()
    // compare the expiry time of the item with the current time
    if (now.getTime() > item.expiry) {
      // If the item is expired, delete the item from storage
      // and return null
      localStorage.removeItem(key)
      return null
    }
    return item.value
  }
}

export default new ExpenseService();
