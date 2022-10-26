import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { FooterComponent } from './shop/components/footer.component';
import { HeaderComponent } from './shop/components/header.component';
import { ShopRoutingModule } from './shop/shop-routing.module';
import { HttpClientModule, HttpHandler, HttpEvent } from '@angular/common/http';
import { ReactiveFormsModule } from '@angular/forms';
import { ToastrModule } from 'ngx-toastr';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { ShopModule } from './shop/shop.module';
import { RegisterComponent } from './shop/components/register.component';
import { AuthGuard } from './shop/components/auth.guard';
import { MatAutocompleteModule } from '@angular/material/autocomplete';
import { MatSliderModule } from '@angular/material/slider';
import { MatInputModule } from '@angular/material/input';




@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,
    FooterComponent,
    // RegisterComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    ShopRoutingModule,
    HttpClientModule,
    ReactiveFormsModule,
    BrowserAnimationsModule,
    ShopModule,
    MatAutocompleteModule,
    MatSliderModule,
    MatInputModule

    // AuthGuard
  ],
  providers: [
//     {
//     provide: HTTP_INTERCEPTORS,
//     useClass: HeadersInterceptor,
//     multi: true
// }
],
  bootstrap: [AppComponent]
})
export class AppModule { }
