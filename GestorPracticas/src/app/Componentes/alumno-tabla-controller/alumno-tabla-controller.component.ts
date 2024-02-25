import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { CrudService } from '../../service/crud.service'; // Asegúrate que la ruta sea correcta
import { SessionService } from '../../service/session.service'; // Asegúrate que la ruta sea correcta

@Component({
  selector: 'app-alumno-tabla-controller',
  standalone: true,
  imports: [],
  templateUrl: './alumno-tabla-controller.component.html',
  styleUrls: ['./alumno-tabla-controller.component.css']
})
export class AlumnoTablaControllerComponent implements OnInit {
  entradas: any[] = [];
  nombreUsuario = 'Nombre usuario';

  constructor(private crud: CrudService, private sessionService: SessionService, private router: Router) {
    this.crud
    .read('tablaAlumno', this.sessionService.obtenerUsuario().dni_alum)
    .subscribe((respuesta: any) => {
      if(respuesta.success){
        this.entradas = respuesta.data;
      } else {
        this.entradas = [];
      }
    })
  }

  ngOnInit(): void {
    this.nombreUsuario = this.sessionService.obtenerUsuario().nom_alum;
  }

  salir() {
    this.sessionService.finalizarSesion();
    this.router.navigate(['/login']);
  }

  crear() {
    this.router.navigate(['/alumno-home-controller']); // Asegúrate que la ruta es la correcta
  }
}
