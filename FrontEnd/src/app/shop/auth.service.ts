import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { map } from 'rxjs/operators';
import { BehaviorSubject, Observable } from 'rxjs';
import { Router } from '@angular/router';
import { environment } from '../../environments/environment';
import { User } from './shop';

@Injectable({
  providedIn: 'root'
})
export class AuthService {

  public userSubject: BehaviorSubject<User>;
  public _userManager: any;
  public user: Observable<User>;
  token: any;

  constructor(private http: HttpClient,
    private router: Router) {
    this.userSubject = new BehaviorSubject<User>(
      JSON.parse(localStorage.getItem('currentUser') || '{}')
    );
    this.user = this.userSubject.asObservable();
  }
  public get userValue(): User {
    return this.userSubject.value;
  }

  loginSer(email: string, password: string) {
    return this.http.post(environment.urlLogin, { email, password }).pipe(
      map((token) => {
        let user: User = {
          email: email,
          token: token,
        };
        localStorage.setItem('currentUser', JSON.stringify(user));
        this.userSubject.next(user);
        return user;
      })
    );
  }
  logout() {

    localStorage.removeItem('currentUser');
    let user: User = {
      email: null,
      token: null,
    };
    this.userSubject.next(user);
  }
}
