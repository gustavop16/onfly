import { AxiosError, AxiosInterceptorOptions, AxiosResponse } from 'axios';
import authenticationService from '../api/services/authentication.service';

export class JWTResponseInterceptor {
  static options: AxiosInterceptorOptions = {};

  static success(
    value: AxiosResponse<any, any>
  ): AxiosResponse<any, any> | Promise<AxiosResponse<any, any>> {
    return value;
  }

  static error(error: any) {
    if (error instanceof AxiosError) {
      if (
        error.response?.status === 401 &&
        (<string | undefined>error.response.data.message)
          ?.toLowerCase()
          .match(/token.*(expired)|(invalid)|(not found)/gm)?.length
      ) {
        const currentPath = window.location.pathname;

        if (currentPath !== '/auth/login') {
          authenticationService.signOut({
            must_login_again: true,
            redirect_to: currentPath,
          });
        }
      }
    }

    return Promise.reject(error);
  }
}
