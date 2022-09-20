import { BehaviorSubject } from 'rxjs';
import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { HttpClient } from '@angular/common/http';
import { ActivatedRoute, Router } from '@angular/router';
import { ToastrService } from 'ngx-toastr';
import { AuthService } from '../auth.service';
import { first } from 'rxjs/operators';
import * as $ from 'jquery';

@Component({
  selector: 'app-login',
  templateUrl: '../templates/login.component.html',
})
export class LoginComponent implements OnInit {
  loginForm !: FormGroup;
  login: any;
  submitted = false;
  token: any;
  error ='';
  url:any;
  message: string = 'login successfully';
  constructor(private authService: AuthService,
    private http: HttpClient,
    private route: ActivatedRoute,
    private fb: FormBuilder,
    private _Router: Router,
    private toastrService: ToastrService,) { }

  ngOnInit(): void {
    this.loginForm = this.fb.group({
      email: ['', [Validators.required, Validators.email]],
      password: ['', [Validators.required, Validators.minLength(6)]],
    })
  }

  get f() {
    return this.loginForm.controls;
  }
  handdleLogin() {
    this.submitted = true;
    if (this.loginForm.invalid) {
      return;
    }

    this.authService
      .loginSer(this.f['email'].value, this.f['password'].value)
      .pipe(first())
      .subscribe({
        next: () => {
          this._Router.navigate(['/home']);
        },
        error: (error) => {
          this.error = error;
        },
      });
  }
  googleLogin(provider:any){
    this.authService.loginGoogle(provider).subscribe(res => {
      console.log( res);
       this.url=res;
       var req = new XMLHttpRequest();
req.open('GET', this.url, true);
req.send();
if (req.status != 200) {
    //  Error
}
console.log(req);



    // ( window.location.href = this.url).subscribe(ressults => {

    // }






      // return this.http.get(this.url)

    })
  }
}



