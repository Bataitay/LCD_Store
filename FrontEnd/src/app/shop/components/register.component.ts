import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { ToastrService } from 'ngx-toastr';
import { Register } from '../shop';
import { ShopService } from '../shop.service';
import { MustMatch} from './confirmed.validator.';
@Component({
  selector: 'app-register',
  templateUrl: '../templates/register.component.html',
})
export class RegisterComponent implements OnInit {
  registerForm !: FormGroup;
  register:any;
  submitted = false;
  constructor(private shopService: ShopService,
    private route: ActivatedRoute,
    private fb: FormBuilder,
    private _Router: Router,
    private toastrService: ToastrService,) { }

  ngOnInit(): void {
    this.registerForm = this.fb.group({
      email: ['', [Validators.required,Validators.email]],
      password: ['',[Validators.required,Validators.minLength(6)]],
      password_confirmation: ['', [Validators.required]],
    },
    {
      Validator: MustMatch('password','password_confirmation')
    });
  }
  get f(){
    return this.registerForm.controls;
  }
  handdleRegister(){
    this.submitted = true;
    if(this.registerForm.invalid){
      return;
    }
    let register: Register = {
      email: this.registerForm.value.email,
      password: this.registerForm.value.password,
      password_confirmation: this.registerForm.value.password_confirmation,
    }
    this.shopService.registerSer(register).subscribe(res => {
      this.registerForm.reset();
      this.register = res;
      if (this.register.status == true) {
        this._Router.navigate(['/login']);
        this.toastrService.success(JSON.stringify(this.register.message))
      } else {
        this.toastrService.error(JSON.stringify(this.register.message))
      }
    });
  }
}
