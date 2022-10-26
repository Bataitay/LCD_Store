import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { ToastrService } from 'ngx-toastr';
import { AuthService } from '../auth.service';
import { first } from 'rxjs/operators';

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
  message: string = 'login successfully';
  constructor(private authService: AuthService,
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
}



