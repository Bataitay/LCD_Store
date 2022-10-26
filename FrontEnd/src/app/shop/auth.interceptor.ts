import { Injectable, Inject } from "@angular/core"
import { HttpHandler, HttpInterceptor, HttpRequest,HttpEvent, HttpErrorResponse, HttpStatusCode } from "@angular/common/http"
import { AuthService } from "./auth.service"
import { catchError, Observable, throwError } from "rxjs"
import { Router } from "@angular/router";

@Injectable()

export class AuthInterceptor implements HttpInterceptor {
  intercept(req: HttpRequest<unknown>, next: HttpHandler ): Observable<HttpEvent<unknown>>{
    const token = localStorage.getItem('conduit-token');

    if (token) {
      req = req.clone({
        setHeaders: {
          Authorization: `Token ${token}`
        }
      });
    }
      return next.handle(req)
    }
}
@Injectable()
export class ErrorsInterceptor implements HttpInterceptor {

  private router = Inject(Router);
  intercept(request: HttpRequest<unknown>, next: HttpHandler ): Observable<HttpEvent<unknown>>{
    const token = localStorage.getItem('conduit-token');
    return next.handle(request).pipe(
      catchError((err: HttpErrorResponse) => {
        if (err.status === HttpStatusCode.Unauthorized) {
          localStorage.removeItem('conduit-token');
          this.router.navigate(['/']);
        }
        return throwError(() => Error(undefined))
      })
    )

  }
}
