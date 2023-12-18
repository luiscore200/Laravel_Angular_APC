import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { User } from '../user';

@Injectable({
  providedIn: 'root'
})
export class ApiService {
  url:string= 'http://127.0.0.1:8000/api'


  constructor(private http:HttpClient) { }

  login(objeto:User):Observable<User>{
    return this.http.post<User>(this.url+'/login', objeto);
  }

  register(objeto:User):Observable<User>{
    return this.http.post<User>(this.url+'/register', objeto);
  }
  sendPasswordResetLink(objeto:User):Observable<User>{
    return this.http.post<User>(this.url+'/sendPasswordResetLink', objeto);
  }
  ChangePassword(objeto:User):Observable<User>{
    return  this.http.post<User>(this.url+'/resetPassword', objeto);

  }
  //products
  getAllImage():Observable<any>{
    return this.http.get<any>(this.url+'/indexProduct');
  
  }
}
