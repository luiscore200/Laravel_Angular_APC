import { Component, OnInit } from '@angular/core';
import { ApiService } from 'src/app/services/api.service';

@Component({
  selector: 'app-store',
  templateUrl: './store.component.html',
  styleUrls: ['./store.component.css']
})
export class StoreComponent implements OnInit{
  imageUrl: any;
  imagesUrl!:[any]; 

  constructor(private api:ApiService){}


  ngOnInit(): void {
       this.loadAllImages();
  }

  loadAllImages():void{
    this.api.getAllImage().subscribe(
      (data) => {
        this.handleResponseAll(data);
      },
      (error) => {
        console.error(error);
      }
    );
  }

  handleResponse(data:any){
    console.log(data)
    this.imageUrl= data;
  }

  handleResponseAll(data:[any]){
    console.log(data)
    this.imagesUrl= data;
  }
}
