import { Component } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { Router } from '@angular/router';
import { CrudService } from '../../service/crud.service';
import { SessionService } from '../../service/session.service';

@Component({
  selector: 'app-alumno-home-controller',
  standalone: true,
  imports: [FormsModule],
  templateUrl: './alumno-home-controller.component.html',
  styleUrls: ['./alumno-home-controller.component.css']
})
export class AlumnoHomeControllerComponent {
  fecha: any = '';
  tipoPractica: any = '';
  totalHoras: any = null;
  actividad: any = '';
  observaciones: any = '';
  dniAlumno: any = '';
  
  constructor(private crud: CrudService, private router: Router, private sessionService: SessionService) {
    // Suponiendo que puedas obtener el DNI del alumno así:
    this.dniAlumno = this.sessionService.obtenerUsuario().dni_alum;
  }

  crearEntrada() {
    const datosEntrada = {
      fecha: this.fecha,
      tipo_practica: this.tipoPractica,
      total_horas: this.totalHoras,
      actividad: this.actividad,
      observaciones: this.observaciones,
      dni_alum: this.sessionService.obtenerUsuario().dni_alum
    };

    this.crud.create('introducirTablaAlumno', datosEntrada).subscribe((respuesta: any) => {
      if (respuesta.success) {
        // Navegar a donde quieras después de la creación exitosa
        this.router.navigate(['/alumno-tabla-controller']);
      } else {
        alert("No se ha podido crear la entrada");
      }
    });
  }

  salir() {
    this.sessionService.finalizarSesion();
    this.router.navigate(['/login']);
  }

  volverTabla(){
    this.router.navigate(['/alumno-tabla-controller']);
  }
}
