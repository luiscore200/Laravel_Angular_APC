import { Component } from '@angular/core';
import { AuthService } from 'src/app/services/auth.service';
import { TokenService } from 'src/app/services/token.service';
import {  Router } from '@angular/router';

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.css']
})
export class NavbarComponent {
  public loggedIn!:boolean;

  constructor(private auth:AuthService, private router:Router, private token:TokenService){}

  ngOnInit(){
    
    this.auth.authStatus.subscribe(value => this.loggedIn= value);
   
  }
  logOut(){
    this.token.remove();
    this.auth.changeAuthStatus(false);
    this.router.navigateByUrl('/login')
  }
}
