import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { AuthGuard } from './components/auth.guard';
import { CartComponent } from './components/cart.component';
import { CheckoutComponent } from './components/checkout.component';
import { HomeComponent } from './components/home.component';
import { LoginComponent } from './components/login.component';
import { OrderCheckComponent } from './components/order-check.component';
import { OrderDetailComponent } from './components/order-detail.component';
import { OrderPayOnlineComponent } from './components/order-pay-online.component';
import { ProductDetailsComponent } from './components/product-details.component';
import { ProdutListComponent } from './components/produt-list.component';
import { RegisterComponent } from './components/register.component';

const routes: Routes = [
  { path: '', redirectTo: '/home', pathMatch: 'full' },
  { path: 'home', component: HomeComponent },
  {
    path: 'login', component: LoginComponent,
  },
  {
    path: 'register', component: RegisterComponent,
  },
  { path: 'cart', component: CartComponent },
  {
    path: 'checkout', component: CheckoutComponent,
    canActivate: [AuthGuard]
  },
  { path: 'product-list', component: ProdutListComponent },
  { path: 'product-detail/:id', component: ProductDetailsComponent },
  { path: 'order-detail/:id', component: OrderDetailComponent },
  { path: 'order-pay-online/:id', component: OrderPayOnlineComponent },
  { path: 'order/check', component: OrderCheckComponent },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
  providers: []

})
export class ShopRoutingModule { }
