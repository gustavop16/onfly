import jwt_decode from 'jwt-decode';
import router from '../../../router';
import { LoginModel, TokenModel } from '../../api/models';
import { api } from '../../api/services';
import userService from '../../api/services/user.service';
import store, { OptionsType } from '../../store';

export interface SignOutOptions {
  must_login_again?: boolean;
  redirect_to?: string;
}

class AuthenticationService {
  initAuth(): Promise<void> {
    return new Promise((resolve) => {
    
      const access_token  = this.getWithExpiry("token")
      const token_type    = this.getWithExpiry("token_type")
      

      if (access_token && token_type) {
        try {
          const { sub } = jwt_decode(access_token) as TokenModel;

          store.dispatch('setAuth', true);
   
          api.defaults.headers.common.authorization = `${token_type} ${access_token}`;

          resolve();

          userService
            .findById(Number(sub))
            .then((response) => {
              const user = response.data.data;
              this.login({
                access_token,
                token_type,
                user,
              });
            })
            .catch(() => {
              this.signOut();
            });
        } catch (err) {
          this.signOut();
          resolve();
        }
      } else {

        console.log('verifica token');
        console.log('>> '+access_token)
        console.log('>> '+token_type)

        resolve();
      }
    });
  }

  isLoggedIn() {
    return store.state.authenticated;
  }

  logout() {
    
    
    store.dispatch('setAuth', false);
    store.dispatch('setUser', null);
  
    localStorage.removeItem('token');
    localStorage.removeItem('token_type');

    api.defaults.headers.common.authorization = '';

  }

  login(payload: LoginModel) {
    store.dispatch('setAuth', true);
    store.dispatch('setUser', payload.user);

    this.setWithExpiry("user", payload.user);
    
    this.setWithExpiry("token", payload.access_token);
    this.setWithExpiry("token_type", payload.token_type);

    api.defaults.headers.common.authorization = `${payload.token_type} ${payload.access_token}`;
  }

  signIn(payload: LoginModel, redirect_to: string = '/') {
    this.logout();
    this.login(payload);

    router.push(decodeURIComponent(redirect_to));
  }

  signOut(options?: SignOutOptions) {

    this.logout();
    const query: OptionsType[] = [];
    let authRoute = '/auth/login?';

    if (options?.must_login_again) {
      query.push({
        key: 'must_login_again',
        value: String(options?.must_login_again),
      });
    }

    if (options?.redirect_to) {
      query.push({
        key: 'redirect_to',
        value: encodeURIComponent(options.redirect_to),
      });
    }

    const queryParams = query
      .map((param) => `${param.key}=${param.value}`)
      .join('&');

    if (queryParams.length) {
      authRoute += queryParams;
    }
    
  }

  setWithExpiry(key, value) {
    const now = new Date()
    const ttl = 172800000; // 2 dias

    // `item` is an object which contains the original value
    // as well as the time when it's supposed to expire
    const item = {
      value: value,
      expiry: now.getTime() + ttl,
    }
    localStorage.setItem(key, JSON.stringify(item))
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

export default new AuthenticationService();
