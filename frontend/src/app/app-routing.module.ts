import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { LoginComponent } from './components/login/login.component';
import { SignupComponent } from './components/signup/signup.component';
import { ProfileComponent } from './components/profile/profile.component';
import { RequestResetComponent } from './components/password/request-reset/request-reset.component';
import { ResponseResetComponent } from './components/password/response-reset/response-reset.component';
import { StoreComponent } from './components/store/store.component';
import { BeforeloginService } from './services/beforelogin.service';
import { AfterloginService } from './services/afterlogin.service';

const routes: Routes = [
  
{ path: '', redirectTo: 'store', pathMatch: 'full' },
{
  path: 'store',
  component: StoreComponent,
  canActivate: []
  
},
{
  path: 'login',
  component: LoginComponent,
  canActivate: [BeforeloginService]
},
{
  path: 'signup',
  component: SignupComponent,
  canActivate: [BeforeloginService]
},
{
  path: 'profile',
  component: ProfileComponent,
  canActivate: [AfterloginService]
},
{
  path: 'request-password-reset',
  component: RequestResetComponent,
  canActivate: [BeforeloginService]
},
{
  path: 'response-password-reset',
  component: ResponseResetComponent,
  canActivate: [BeforeloginService]
},
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
