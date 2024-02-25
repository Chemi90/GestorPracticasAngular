import { Component } from '@angular/core';
import { RouterOutlet } from '@angular/router';
import { LoginComponent } from './Componentes/login/login.component';
import { AlumnoHomeControllerComponent } from './Componentes/alumno-home-controller/alumno-home-controller.component';
import { AlumnoTablaControllerComponent } from './Componentes/alumno-tabla-controller/alumno-tabla-controller.component';

@Component({
  selector: 'app-root',
  standalone: true,
  imports: [RouterOutlet, LoginComponent, AlumnoHomeControllerComponent, AlumnoTablaControllerComponent],
  templateUrl: './app.component.html',
  styleUrl: './app.component.css'
})
export class AppComponent {
}