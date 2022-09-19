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
import { LoginComponent } from './components/login.component';
import { AuthGuard } from './components/auth.guard';
import { OrderDetailComponent } from './components/order-detail.component';
import { OrderPayOnlineComponent } from './components/order-pay-online.component';
import { OrderCheckComponent } from './components/order-check.component';
import { MatAutocompleteModule } from '@angular/material/autocomplete';
import { MatSliderModule } from '@angular/material/slider';
import { MatInputModule } from '@angular/material/input';

@NgModule({
  declarations: [
    HomeComponent,
    CartComponent,
    CheckoutComponent,
    ProdutListComponent,
    ProductDetailsComponent,
    RegisterComponent,
    LoginComponent,
    OrderDetailComponent,
    OrderPayOnlineComponent,
    OrderCheckComponent,
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
    MatAutocompleteModule,
    MatSliderModule,
    MatInputModule
  ],
  providers: [],
  schemas:[CUSTOM_ELEMENTS_SCHEMA]
})
export class ShopModule { }
