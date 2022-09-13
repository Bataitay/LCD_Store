import { CUSTOM_ELEMENTS_SCHEMA, NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ToastrModule } from 'ngx-toastr';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { HttpClientModule } from '@angular/common/http';
import { ReactiveFormsModule,FormsModule } from '@angular/forms';
import {RouterModule} from '@angular/router';
import { HomeComponent } from './components/home.component';
import { CartComponent } from './components/cart.component';
import { CheckoutComponent } from './components/checkout.component';
import { ProdutListComponent } from './components/produt-list.component';
import { ProductDetailsComponent } from './components/product-details.component';
import { RegisterComponent } from './components/register.component';

@NgModule({
  declarations: [
    HomeComponent,
    CartComponent,
    CheckoutComponent,
    ProdutListComponent,
    ProductDetailsComponent,
    RegisterComponent
  ],
  imports: [
    CommonModule,
    RouterModule,
    HttpClientModule,
    ReactiveFormsModule,
    ToastrModule.forRoot(
      {
        timeOut:4000,
        positionClass: 'toast-top-right',
        preventDuplicates: true
      }
    ),
    BrowserAnimationsModule,
    FormsModule,
  ],
  schemas:[CUSTOM_ELEMENTS_SCHEMA]
})
export class ShopModule { }
