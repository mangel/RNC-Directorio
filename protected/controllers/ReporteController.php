<?php
class ReporteController extends Controller{
	
	/**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
	public function accessRules()
	{
        
		return array(
				array('allow',  // allow all users to perform 'index' and 'view' actions
						'actions'=>array('index','view'),
						'users'=>array('@'),
						'roles'=>array('admin'),
				),
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
						'actions'=>array('create','update'),
						'users'=>array('@'),
						'roles'=>array('admin'),
				),
				array('allow', // allow admin user to perform 'admin' and 'delete' actions
						'actions'=>array('admin','delete'),
						'roles'=>array('admin'),
				),
				array('deny',  // deny all users
						'users'=>array('*'),
				),
		);
	}
	
	/**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
	public function actionCreate()
	{
		if(Yii::app()->user->getId() !== null)
		{
			$model = new Reporte();
			$fechaReporte = Yii::app()->Date->now();
			if(isset($_POST['Reporte'])){
				
				try{
                    $criteria = new CDbCriteria;
                    //$criteria->compare("t.estado", 2);
                    $criteria->condition = "t.estado = 2";
                    $_POST['Reporte']['estado'] = 1;
                    $criteria->with = array('registros','registros.entidad','county','composicion_general','tamano_coleccion','tipos_en_coleccion','contactos','dilegenciadores','county','archivos');
                    $registros_update = Registros_update::model()->findAll($criteria);
                    
                    $dataReporte = array();
                    $dataReporte[0]['entidadTitular'] 			= 'Titular';
                    $dataReporte[0]['entidadTipoTitular']		= 'Tipo de titular';
                    $dataReporte[0]['entidadNit']				= 'Identificación';
                    $dataReporte[0]['entidadRepresentante']		= 'Representante legal';
                    $dataReporte[0]['entidadRepresentanteId']	= 'Identificación representante';
                    $dataReporte[0]['entidadDireccion']			= 'Dirección';
                    $dataReporte[0]['entidadDepartamento']		= 'Departamento';
                    $dataReporte[0]['entidadCiudad']			= 'Municipio';
                    $dataReporte[0]['entidadTelefono']			= 'Teléfono';
                    $dataReporte[0]['entidadEmail']				= 'Correo electrónico';
                    $dataReporte[0]['coleccionNumero'] 			= 'No. Colección';
                    $dataReporte[0]['coleccionFechaReg']		= 'Fecha de registro';
                    $dataReporte[0]['coleccionFecha'] 			= 'Última actualización';
                    $dataReporte[0]['reporteNombre'] 			= 'Nombre de la colección';
                    $dataReporte[0]['reporteAcronimo'] 			= 'Acrónimo';
                    $dataReporte[0]['reporteFundacion'] 		= 'Año de fundación';
                    $dataReporte[0]['reporteDescripcion'] 		= 'Descripción';
                    $dataReporte[0]['reporteDireccion'] 		= 'Dirección de la colección';
                    $dataReporte[0]['reporteDepartamento']		= 'Departamento';
                    $dataReporte[0]['reporteCiudad'] 			= 'Municipio';
                    $dataReporte[0]['reporteTelefono'] 			= 'Teléfono';
                    $dataReporte[0]['reporteEmail'] 			= 'Correo electrónico';
                    $dataReporte[0]['coberturaTaxonomica'] 		= 'Cobertura taxonómica';
                    $dataReporte[0]['coberturaGeografica'] 		= 'Cobertura geográfica';
                    $dataReporte[0]['coberturaTemporal'] 		= 'Cobertura temporal';
                    $dataReporte[0]['tamanoTipo']		 		= 'Tipo de preservación';
                    $dataReporte[0]['tamanoUnidad']		 		= 'Unidad de medida';
                    //$dataReporte[0]['tamanoCantidad']	 		= 'Cantidad de ejemplares';
                    $dataReporte[0]['nivelGrupo']		 		= 'Grupo biológico';
                    $dataReporte[0]['nivelSubgrupo']	 		= 'Subgrupo biológico';
                    $dataReporte[0]['nivelEjemplares']	 		= 'No. Ejemplares';
                    $dataReporte[0]['nivelCatalogados']	 		= 'Ejemplares catalogados';
                    $dataReporte[0]['nivelSistematizados'] 		= 'Ejemplares sistematizados';
                    $dataReporte[0]['nivelOrden']		 		= 'Ejemplares identificados al nivel de orden';
                    $dataReporte[0]['nivelFamilia']		 		= 'Ejemplares identificados al nivel de familia';
                    $dataReporte[0]['nivelGenero']		 		= 'Ejemplares identificados al nivel de genero';
                    $dataReporte[0]['nivelEspecie']		 		= 'Ejemplares identificados al nivel de especie';
                    $dataReporte[0]['sistematizacion']	 		= 'Sistematización y publicación';
                    $dataReporte[0]['tipoEjemplarTipo']			= 'Ejemplares tipo';
                    $dataReporte[0]['tipoEjemplarTipoCant']		= 'Cantidad ejemplares tipo';
                    $dataReporte[0]['tipoGrupo']		 		= 'Grupo biológico';
                    //$dataReporte[0]['tipoEjemplar']		 		= 'Información sobre el ejemplar tipo';
                    //$dataReporte[0]['tipoNombreCientifico']		= 'Nombre Científico';
                    $dataReporte[0]['tipoCantidad']		 		= 'Cantidad de ejemplares';
                    $dataReporte[0]['documentoAnexos']	 		= 'Listado de anexos';
                    $dataReporte[0]['informacionAdicional']	 	= 'Información adicional';
                    $dataReporte[0]['informacionPagina']	 	= 'Página web de la colección';
                    $dataReporte[0]['contactoNombre']		 	= 'Persona de contacto';
                    $dataReporte[0]['contactoCargo']		 	= 'Cargo';
                    $dataReporte[0]['contactoDependencia']	 	= 'Dependencia';
                    $dataReporte[0]['contactoDireccion']	 	= 'Dirección de correspondencia';
                    $dataReporte[0]['contactoDepartamento']	 	= 'Departamento';
                    $dataReporte[0]['contactoCiudad']		 	= 'Municipio';
                    $dataReporte[0]['contactoTelefono']		 	= 'Teléfono(s)';
                    $dataReporte[0]['contactoEmail']		 	= 'Correo electrónico';
                    $dataReporte[0]['dilegenciadorNombre']	 	= 'Nombre diligenciador';
                    $dataReporte[0]['dilegenciadorDependencia']	= 'Dependencia';
                    $dataReporte[0]['dilegenciadorCargo']		= 'Cargo';
                    $dataReporte[0]['dilegenciadorTelefono']	= 'Teléfono';
                    $dataReporte[0]['dilegenciadorEmail']		= 'Correo electrónico';
                    $dataReporte[0]['estado']					= 'Estado';
                    
                    $cont = 1;
                    
                    foreach ($registros_update as $data){
                        
                        $countTamano = count($data->tamano_coleccion);
                        $countComposicion = count($data->composicion_general);
                        $countTipo = count($data->tipos_en_coleccion);
                        
                        $dataM = '';
                        if($countTamano >= $countComposicion && $countTamano >= $countTipo){
                            $dataM = $data->tamano_coleccion;
                        }else if($countComposicion >= $countTamano && $countComposicion >= $countTipo){
                            $dataM = $data->composicion_general;
                        }else if($countTipo >= $countTamano && $countTipo >= $countComposicion){
                            $dataM = $data->tipos_en_coleccion;
                        }
                        
                        foreach ($dataM as $k => $value){

                            $dataReporte[$cont]['entidadTitular'] 			= $data->registros->entidad->titular;
                            $dataReporte[$cont]['entidadTipoTitular']		= CHtml::encode(($data->registros->entidad->tipo_titular == 1) ? "Persona Natural" : (($data->registros->entidad->tipo_titular == 2) ? "Persona Jurídica" : "No Asignado"));
                            $dataReporte[$cont]['entidadNit'] 				= $data->registros->entidad->nit;
                            $dataReporte[$cont]['entidadRepresentante']		= $data->registros->entidad->representante_legal;
                            $dataReporte[$cont]['entidadRepresentanteId']	= $data->registros->entidad->representante_id;
                            $dataReporte[$cont]['entidadDireccion']			= $data->registros->entidad->direccion;
                            $dataReporte[$cont]['entidadDepartamento']		= isset($data->registros->entidad->county->department->department_name) ? $data->registros->entidad->county->department->department_name : "";
                            $dataReporte[$cont]['entidadCiudad']			= isset($data->registros->entidad->county->county_name) ? $data->registros->entidad->county->county_name : "";
                            $dataReporte[$cont]['entidadTelefono']			= $data->registros->entidad->telefono;
                            $dataReporte[$cont]['entidadEmail']				= $data->registros->entidad->email;
                            $dataReporte[$cont]['coleccionNumero'] 			= $data->registros->numero_registro;
                            $dataReporte[$cont]['coleccionFechaReg']		= $data->registros->fecha_dil;
                            $dataReporte[$cont]['coleccionFecha']			= $data->fecha_act;
                            $dataReporte[$cont]['reporteNombre'] 			= $data->nombre;
                            $dataReporte[$cont]['reporteAcronimo'] 			= $data->acronimo;
                            $dataReporte[$cont]['reporteFundacion'] 		= $data->fecha_fund;
                            $dataReporte[$cont]['reporteDescripcion'] 		= $data->descripcion;
                            $dataReporte[$cont]['reporteDireccion'] 		= $data->direccion;
                            $dataReporte[$cont]['reporteDepartamento']		= isset($data->county->department->department_name) ? $data->county->department->department_name : "";
                            $dataReporte[$cont]['reporteCiudad'] 			= isset($data->county->county_name) ? $data->county->county_name : "";
                            $dataReporte[$cont]['reporteTelefono'] 			= $data->telefono;
                            $dataReporte[$cont]['reporteEmail'] 			= $data->email;
                            $dataReporte[$cont]['coberturaTaxonomica'] 		= $data->cobertura_tax;
                            $dataReporte[$cont]['coberturaGeografica'] 		= $data->cobertura_geog;
                            $dataReporte[$cont]['coberturaTemporal'] 		= $data->cobertura_temp;
                            
                            if(isset($data->tamano_coleccion[$k])){
                                $dataReporte[$cont]['tamanoTipo'] 			= "-";//($data->tamano_coleccion[$k]->tipo_preservacion_id == 22) ? $data->tamano_coleccion[$k]->otro : $data->tamano_coleccion[$k]->tipo_preservacion->nombre;
                                $dataReporte[$cont]['tamanoUnidad'] 		= $data->tamano_coleccion[$k]->unidad_medida;
                                //$dataReporte[$cont]['tamanoCantidad']		= $data->tamano_coleccion[$k]->cantidad;
                            }else {
                                $dataReporte[$cont]['tamanoTipo'] 			= "-";
                                $dataReporte[$cont]['tamanoUnidad'] 		= "-";
                                //$dataReporte[$cont]['tamanoCantidad']		= "-";
                            }
                            
                            if(isset($data->composicion_general[$k])){
                                $dataReporte[$cont]['nivelGrupo']			= $data->composicion_general[$k]->grupo_taxonomico->nombre;
                                $dataReporte[$cont]['nivelSubgrupo']		= ($data->composicion_general[$k]->subgrupo_taxonomico_id == 2) ? $data->composicion_general[$k]->subgrupo_otro : $data->composicion_general[$k]->subgrupo_taxonomico->nombre;
                                $dataReporte[$cont]['nivelEjemplares']		= $data->composicion_general[$k]->numero_ejemplares;
                                $dataReporte[$cont]['nivelCatalogados']		= $data->composicion_general[$k]->numero_catalogados;
                                $dataReporte[$cont]['nivelSistematizados']	= $data->composicion_general[$k]->numero_sistematizados;
                                $dataReporte[$cont]['nivelOrden']			= isset($data->composicion_general[$k]->numero_nivel_orden) ? $data->composicion_general[$k]->numero_nivel_orden : "";
                                $dataReporte[$cont]['nivelFamilia']			= $data->composicion_general[$k]->numero_nivel_familia;
                                $dataReporte[$cont]['nivelGenero']			= $data->composicion_general[$k]->numero_nivel_genero;
                                $dataReporte[$cont]['nivelEspecie']			= $data->composicion_general[$k]->numero_nivel_especie;
                                $dataReporte[$cont]['sistematizacion']		= $data->sistematizacion;
                            }else {
                                $dataReporte[$cont]['nivelGrupo']			= "-";
                                $dataReporte[$cont]['nivelEjemplares']		= "-";
                                $dataReporte[$cont]['nivelCatalogados']		= "-";
                                $dataReporte[$cont]['nivelSistematizados']	= "-";
                                $dataReporte[$cont]['nivelFamilia']			= "-";
                                $dataReporte[$cont]['nivelGenero']			= "-";
                                $dataReporte[$cont]['nivelEspecie']			= "-";
                            }
                            
                            $dataReporte[$cont]['tipoEjemplarTipo']			= ($data->ejemplar_tipo == 0) ? "Si" : "No";
                            $dataReporte[$cont]['tipoEjemplarTipoCant']		= $data->ej_tipo_cantidad;
                            if(isset($data->tipos_en_coleccion[$k])){
                                $dataReporte[$cont]['tipoGrupo']			= $data->tipos_en_coleccion[$k]->grupo;
                                //$dataReporte[$cont]['tipoEjemplar']			= $data->tipos_en_coleccion[$k]->informacion_ejemplar;
                                //$dataReporte[$cont]['tipoNombreCientifico']	= $data->tipos_en_coleccion[$k]->nombre_cientifico;
                                $dataReporte[$cont]['tipoCantidad']			= $data->tipos_en_coleccion[$k]->cantidad;
                            }else {
                                $dataReporte[$cont]['tipoGrupo']			= "-";
                                //$dataReporte[$cont]['tipoEjemplar']			= "-";
                                //$dataReporte[$cont]['tipoNombreCientifico']	= "-";
                                $dataReporte[$cont]['tipoCantidad']			= "-";
                            }
                            
                            $dataReporte[$cont]['documentoAnexos']			= $data->listado_anexos;
                            $dataReporte[$cont]['informacionAdicional']		= $data->info_adicional;
                            $dataReporte[$cont]['informacionPagina']		= $data->pagina_web;
                            
                            $dataReporte[$cont]['contactoNombre']			= $data->contactos->nombre;
                            $dataReporte[$cont]['contactoCargo']			= $data->contactos->cargo;
                            $dataReporte[$cont]['contactoDependencia']		= $data->contactos->dependencia;
                            $dataReporte[$cont]['contactoDireccion']		= $data->contactos->direccion;
                            $dataReporte[$cont]['contactoDepartamento']		= isset($data->contactos->county->department->department_name) ? $data->contactos->county->department->department_name : '-';
                            $dataReporte[$cont]['contactoCiudad']			= isset($data->contactos->county->county_name) ? $data->contactos->county->county_name : '-';
                            $dataReporte[$cont]['contactoTelefono']			= $data->contactos->telefono;
                            $dataReporte[$cont]['contactoEmail']			= $data->contactos->email;
                            
                            $dataReporte[$cont]['dilegenciadorNombre']		= $data->dilegenciadores->nombre;
                            $dataReporte[$cont]['dilegenciadorDependencia']	= $data->dilegenciadores->dependencia;
                            $dataReporte[$cont]['dilegenciadorCargo']		= $data->dilegenciadores->cargo;
                            $dataReporte[$cont]['dilegenciadorTelefono']	= $data->dilegenciadores->telefono;
                            $dataReporte[$cont]['dilegenciadorEmail']		= $data->dilegenciadores->email;
                            $dataReporte[$cont]['estado']					= ($data->estado == 0) ? "Sin Enviar" : (($data->estado == 1) ? "En Revisión" : (($data->estado == 2) ? "Aprobado" : (($data->estado == 3) ? "No Aprobado" : "Aprobado")));
                            
                            $cont++;
                        }					
                        
                        
                    }
                    
                    
                    /*
                    // get a reference to the path of PHPExcel classes
                    $phpExcelPath = Yii::getPathOfAlias('ext.phpexcel.Classes');
                    
                    // Turn off our amazing library autoload
                    spl_autoload_unregister(array('YiiBase','autoload'));
                    
                    // making use of our reference, include the main class
                    // when we do this, phpExcel has its own autoload registration
                    // procedure (PHPExcel_Autoloader::Register();)
                    include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');
                    
                    $objPhpExcel = new PHPExcel();
                    
                    // Once we have finished using the library, give back the
                    // power to Yii...
                    spl_autoload_register(array('YiiBase','autoload'));
                    
                    $objPhpExcel->getProperties()->setCreator("Instituto Alexander Von Humboldt")
                    ->setTitle("Bitácora Colecciones")
                    ->setSubject("Bitácora Colecciones")
                    ->setDescription("Reporte detallado de las Colecciones Existentes");
                    
                    $objPhpExcel->getActiveSheet()->setTitle('Reporte RNC');
                    
                    $dataExcel = array();
                    
                    
                    foreach ($dataReporte as $k => $value){
					$abc = 65;
					$abc_aux = 64;
					$mayor = false;
					foreach ($value as $j => $valueData){
                    if($_POST['Reporte'][$j] == 1){//echo $abc."/";
                    $alfa = chr($abc);
                    
                    if($abc > 90){
                    $abc = 65;
                    $abc_aux++;
                    $mayor = true;
                    $alfa = chr($abc_aux).chr($abc);
                    }else if($mayor){
                    $alfa = chr($abc_aux).chr($abc);
                    }
                    $objPhpExcel->setActiveSheetIndex(0) -> setCellValue($alfa.($k + 1), $valueData);
                    $abc++;
                    }
					}
                    }
                    //print_r($objPhpExcel);
                    //Yii::app()->end();
                    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                    header('Content-Disposition: attachment;filename="ReporteRnc.xlsx"');
                    header('Cache-control: max-age=1');
                    
                    $objWriter = PHPExcel_IOFactory::createWriter($objPhpExcel, 'Excel2007');
                    //$objWriter->save('php://output');
                    $filename = rand(1, 100)."_ReporteRnc.xlsx";
                    $objWriter->save("temp_rnc".DIRECTORY_SEPARATOR.$filename);
                    
                    $mails = array(0 => 'rnc@humboldt.org.co');
					
                    $message 			= new YiiMailMessage;
                    $message->view 		= "bitacoraArchivo";
                    //$data 			= "Mensaje prueba";
                    //$params				= array('data' => $model);
                    $message->subject	= 'Sistema RNC - Bitácora ';
                    $message->from		= 'hescobar@humboldt.org';
                    $message->setBody("",'text/html');
                    $message->setTo($mails);
					
                    $message->attach(Swift_Attachment::fromPath("temp_rnc".DIRECTORY_SEPARATOR.$filename,'multipart/mixed')->setFilename($filename));
                    
                    Yii::app()->mail->send($message);
                    
                    //unlink("temp_rnc".DIRECTORY_SEPARATOR.$filename);
                    
                    Yii::app()->end();*/
                    
                    /*$this->render('_reporte_table',array(
                    'model' => $model,
                    'datos' => json_encode($dataReporte),
                    ));*/
                    
                    $js_aux = array();
                    
                    foreach ($dataReporte as $k => $value){
                        $a = 1;
                        $js_aux_2 = array();
                        foreach ($value as $j => $valueData){
                            if($_POST['Reporte'][$j] == 1){//echo $abc."/";
                                $js_aux_2[] = $valueData;
                                $a++;
                            }
                            
                        }
                        $js_aux[] = $js_aux_2;
                    }
                    //echo count($js_aux);
                    echo json_encode($js_aux);
                    Yii::app()->end();
				}
                catch (Exception $e) {
					$transaction->rollback();
					print_r($e->getMessage());
					Yii::log("Ocurrió un error al enviar la informacion de registro: " . $e->getMessage(), 'error');
					$success_saving_all = false;
					Yii::app()->end();
				}
			}
			$this->render('create',array(
					'model'=>$model,
			));
		}else{
			$this->redirect(array("admin/login"));
		}
	}
	
	public function actionEnviaReporte(){
		if(Yii::app()->user->getId() !== null)
		{
			if(isset($_POST['dataJson'])){
				
				$data = json_decode($_POST['dataJson'][0]);
				
				//Yii::app()->end();
				// get a reference to the path of PHPExcel classes
				$phpExcelPath = Yii::getPathOfAlias('ext.phpexcel.Classes');
				
				// Turn off our amazing library autoload
				spl_autoload_unregister(array('YiiBase','autoload'));
				
				// making use of our reference, include the main class
				// when we do this, phpExcel has its own autoload registration
				// procedure (PHPExcel_Autoloader::Register();)
				include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');
				
				$objPhpExcel = new PHPExcel();
				
				// Once we have finished using the library, give back the
				// power to Yii...
				spl_autoload_register(array('YiiBase','autoload'));
				
				$objPhpExcel->getProperties()->setCreator("Instituto Alexander Von Humboldt")
				->setTitle("Bitácora Colecciones")
				->setSubject("Bitácora Colecciones")
				->setDescription("Reporte detallado de las Colecciones Existentes");
				
				$objPhpExcel->getActiveSheet()->setTitle('Reporte RNC');
				
				$dataExcel = array();
				
				
				foreach ($data as $k => $value){
					$abc = 65;
					$abc_aux = 64;
					$mayor = false;
					foreach ($value as $j => $valueData){
						
                        $alfa = chr($abc);
                        
                        if($abc > 90){
                            $abc = 65;
                            $abc_aux++;
                            $mayor = true;
                            $alfa = chr($abc_aux).chr($abc);
                        }else if($mayor){
                            $alfa = chr($abc_aux).chr($abc);
                        }
                        $objPhpExcel->setActiveSheetIndex(0) -> setCellValue($alfa.($k + 1), $valueData);
                        $abc++;
                    }
					
				}
				//print_r($objPhpExcel);
				//Yii::app()->end();
				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment;filename="ReporteRnc.xlsx"');
				header('Cache-control: max-age=1');
				
				$objWriter = PHPExcel_IOFactory::createWriter($objPhpExcel, 'Excel2007');
				//$objWriter->save('php://output');
				$filename = rand(1, 100)."_ReporteRnc.xlsx";
				$objWriter->save("temp_rnc".DIRECTORY_SEPARATOR.$filename);
				
				$mails = array(0 => 'rnc@humboldt.org.co');
                
				$message 			= new YiiMailMessage;
				$message->view 		= "bitacoraArchivo";
				//$data 			= "Mensaje prueba";
				//$params				= array('data' => $model);
				$message->subject	= 'Sistema RNC - Bitácora ';
				$message->from		= 'hescobar@humboldt.org';
				$message->setBody("",'text/html');
				$message->setTo($mails);
                
				$message->attach(Swift_Attachment::fromPath("temp_rnc".DIRECTORY_SEPARATOR.$filename,'multipart/mixed')->setFilename($filename));
				
				Yii::app()->mail->send($message);
				
				//unlink("temp_rnc".DIRECTORY_SEPARATOR.$filename);
				echo "Ok";
				Yii::app()->end();
			}
		}
	}
	
	public function actionReporte(){
		$model = new Reporte();
		$fechaReporte = Yii::app()->Date->now();
        
		try{
			$criteria = new CDbCriteria;
			//$criteria->condition = "t.estado = 2";
			$criteria->compare("t.estado", 2);
			$criteria->with = array('registros','registros.entidad','county','composicion_general','tamano_coleccion','tipos_en_coleccion','contactos','dilegenciadores','county','archivos');
			$criteria->order = 'registros.numero_registro';
			$registros_update = Registros_update::model()->findAll($criteria);
            
			$dataReporte = array();
			$dataReporte[0]['coleccionNumero'] 			= 'No. Colección';
			$dataReporte[0]['reporteNombre'] 			= 'Nombre de la colección';
			$dataReporte[0]['entidadTitular'] 			= 'Titular';
			$dataReporte[0]['entidadTipoTitular']		= 'Tipo de titular';
			$dataReporte[0]['entidadNit']				= 'Identificación';
			$dataReporte[0]['contactoNombre']		 	= 'Persona de contacto';
			$dataReporte[0]['contactoCargo']		 	= 'Cargo';
			$dataReporte[0]['contactoDependencia']	 	= 'Dependencia';
			$dataReporte[0]['contactoDireccion']	 	= 'Dirección de correspondencia';
			$dataReporte[0]['contactoDepartamento']	 	= 'Departamento';
			$dataReporte[0]['contactoCiudad']		 	= 'Municipio';
			$dataReporte[0]['contactoTelefono']		 	= 'Teléfono(s)';
			$dataReporte[0]['contactoEmail']		 	= 'Correo electrónico';
			$dataReporte[0]['reporteEmail'] 			= 'Correo electrónico';
			$dataReporte[0]['reporteFundacion'] 		= 'Año de fundación';
			$dataReporte[0]['coleccionFechaReg']		= 'Fecha de registro';
			$dataReporte[0]['coleccionFecha'] 			= 'Última actualización';
			$dataReporte[0]['reporteAcronimo'] 			= 'Acrónimo';
			$dataReporte[0]['reporteDescripcion'] 		= 'Descripción';
			$dataReporte[0]['coberturaTaxonomica'] 		= 'Cobertura taxonómica';
			$dataReporte[0]['coberturaGeografica'] 		= 'Cobertura geográfica';
			$dataReporte[0]['coberturaTemporal'] 		= 'Cobertura temporal';
			$dataReporte[0]['tamanoTipo']		 		= 'Tipo de preservación';
			$dataReporte[0]['tamanoUnidad']		 		= 'Unidad de medida';
			$dataReporte[0]['nivelGrupo']		 		= 'Grupo biológico';
			$dataReporte[0]['nivelSubgrupo']	 		= 'Subgrupo biológico';
			$dataReporte[0]['nivelEjemplares']	 		= 'No. Ejemplares';
			$dataReporte[0]['nivelCatalogados']	 		= 'Ejemplares catalogados';
			$dataReporte[0]['nivelSistematizados'] 		= 'Ejemplares sistematizados';
			$dataReporte[0]['nivelOrden']		 		= 'Ejemplares identificados al nivel de orden';
			$dataReporte[0]['nivelFamilia']		 		= 'Ejemplares identificados al nivel de familia';
			$dataReporte[0]['nivelGenero']		 		= 'Ejemplares identificados al nivel de genero';
			$dataReporte[0]['nivelEspecie']		 		= 'Ejemplares identificados al nivel de especie';
			$dataReporte[0]['sistematizacion']	 		= 'Sistematización y publicación';
			$dataReporte[0]['tipoEjemplarTipo']			= 'Ejemplares tipo';
			$dataReporte[0]['tipoEjemplarTipoCant']		= 'Cantidad ejemplares tipo';
			$dataReporte[0]['tipoGrupo']		 		= 'Grupo biológico';
			$dataReporte[0]['tipoCantidad']		 		= 'Cantidad de ejemplares';
			$dataReporte[0]['informacionAdicional']	 	= 'Información adicional';
			$dataReporte[0]['informacionPagina']	 	= 'Página web de la colección';
			$dataReporte[0]['entidadRepresentante']		= 'Representante legal';
			$dataReporte[0]['entidadRepresentanteId']	= 'Identificación representante';
			$dataReporte[0]['reporteDireccion'] 		= 'Dirección de la colección';
			$dataReporte[0]['reporteDepartamento']		= 'Departamento';
			$dataReporte[0]['reporteCiudad'] 			= 'Municipio';
			$dataReporte[0]['reporteTelefono'] 			= 'Teléfono';
            
			$cont = 1;
			
			foreach ($registros_update as $data){
                
				$countTamano = count($data->tamano_coleccion);
				$countComposicion = count($data->composicion_general);
				$countTipo = count($data->tipos_en_coleccion);
                
				$dataM = '';
				if($countTamano >= $countComposicion && $countTamano >= $countTipo){
					$dataM = $data->tamano_coleccion;
				}else if($countComposicion >= $countTamano && $countComposicion >= $countTipo){
					$dataM = $data->composicion_general;
				}else if($countTipo >= $countTamano && $countTipo >= $countComposicion){
					$dataM = $data->tipos_en_coleccion;
				}
                
				foreach ($dataM as $k => $value){
                    
					$dataReporte[$cont]['coleccionNumero'] 			= $data->registros->numero_registro;
					$dataReporte[$cont]['reporteNombre'] 			= $data->nombre;
					$dataReporte[$cont]['entidadTitular'] 			= $data->registros->entidad->titular;
					$dataReporte[$cont]['entidadTipoTitular']		= CHtml::encode(($data->registros->entidad->tipo_titular == 1) ? "Persona Natural" : (($data->registros->entidad->tipo_titular == 2) ? "Persona Jurídica" : "No Asignado"));
					$dataReporte[$cont]['entidadNit'] 				= $data->registros->entidad->nit;
					
					$dataReporte[$cont]['contactoNombre']			= $data->contactos->nombre;
					$dataReporte[$cont]['contactoCargo']			= $data->contactos->cargo;
					$dataReporte[$cont]['contactoDependencia']		= $data->contactos->dependencia;
					$dataReporte[$cont]['contactoDireccion']		= $data->contactos->direccion;
					$dataReporte[$cont]['contactoDepartamento']		= isset($data->contactos->county->department->department_name) ? $data->contactos->county->department->department_name : '-';
					$dataReporte[$cont]['contactoCiudad']			= isset($data->contactos->county->county_name) ? $data->contactos->county->county_name : '-';
					$dataReporte[$cont]['contactoTelefono']			= $data->contactos->telefono;
					$dataReporte[$cont]['contactoEmail']			= $data->contactos->email;
					
					$dataReporte[$cont]['reporteEmail'] 			= $data->email;
					$dataReporte[$cont]['reporteFundacion'] 		= $data->fecha_fund;
					$dataReporte[$cont]['coleccionFechaReg']		= $data->registros->fecha_dil;
					$dataReporte[$cont]['coleccionFecha']			= $data->fecha_act;
					$dataReporte[$cont]['reporteAcronimo'] 			= $data->acronimo;
					$dataReporte[$cont]['reporteDescripcion'] 		= $data->descripcion;
					$dataReporte[$cont]['coberturaTaxonomica'] 		= $data->cobertura_tax;
					$dataReporte[$cont]['coberturaGeografica'] 		= $data->cobertura_geog;
					$dataReporte[$cont]['coberturaTemporal'] 		= $data->cobertura_temp;
					
					if(isset($data->tamano_coleccion[$k])){
						$dataReporte[$cont]['tamanoTipo'] 			= "-";//($data->tamano_coleccion[$k]->tipo_preservacion_id == 22) ? $data->tamano_coleccion[$k]->otro : $data->tamano_coleccion[$k]->tipo_preservacion->nombre;
						$dataReporte[$cont]['tamanoUnidad'] 		= $data->tamano_coleccion[$k]->unidad_medida;
						//$dataReporte[$cont]['tamanoCantidad']		= $data->tamano_coleccion[$k]->cantidad;
					}else {
						$dataReporte[$cont]['tamanoTipo'] 			= "-";
						$dataReporte[$cont]['tamanoUnidad'] 		= "-";
						//$dataReporte[$cont]['tamanoCantidad']		= "-";
					}
					
					if(isset($data->composicion_general[$k])){
						$dataReporte[$cont]['nivelGrupo']			= $data->composicion_general[$k]->grupo_taxonomico->nombre;
						$dataReporte[$cont]['nivelSubgrupo']		= ($data->composicion_general[$k]->subgrupo_taxonomico_id == 2) ? $data->composicion_general[$k]->subgrupo_otro : $data->composicion_general[$k]->subgrupo_taxonomico->nombre;
						$dataReporte[$cont]['nivelEjemplares']		= $data->composicion_general[$k]->numero_ejemplares;
						$dataReporte[$cont]['nivelCatalogados']		= $data->composicion_general[$k]->numero_catalogados;
						$dataReporte[$cont]['nivelSistematizados']	= $data->composicion_general[$k]->numero_sistematizados;
						$dataReporte[$cont]['nivelOrden']			= isset($data->composicion_general[$k]->numero_nivel_orden) ? $data->composicion_general[$k]->numero_nivel_orden : "";
						$dataReporte[$cont]['nivelFamilia']			= $data->composicion_general[$k]->numero_nivel_familia;
						$dataReporte[$cont]['nivelGenero']			= $data->composicion_general[$k]->numero_nivel_genero;
						$dataReporte[$cont]['nivelEspecie']			= $data->composicion_general[$k]->numero_nivel_especie;
						$dataReporte[$cont]['sistematizacion']		= $data->sistematizacion;
					}else {
						$dataReporte[$cont]['nivelGrupo']			= "-";
						$dataReporte[$cont]['nivelEjemplares']		= "-";
						$dataReporte[$cont]['nivelCatalogados']		= "-";
						$dataReporte[$cont]['nivelSistematizados']	= "-";
						$dataReporte[$cont]['nivelFamilia']			= "-";
						$dataReporte[$cont]['nivelGenero']			= "-";
						$dataReporte[$cont]['nivelEspecie']			= "-";
					}
					
					$dataReporte[$cont]['tipoEjemplarTipo']			= ($data->ejemplar_tipo == 0) ? "Si" : "No";
					$dataReporte[$cont]['tipoEjemplarTipoCant']		= $data->ej_tipo_cantidad;
					
					if(isset($data->tipos_en_coleccion[$k])){
						$dataReporte[$cont]['tipoGrupo']			= $data->tipos_en_coleccion[$k]->grupo;
						$dataReporte[$cont]['tipoCantidad']			= $data->tipos_en_coleccion[$k]->cantidad;
					}else {
						$dataReporte[$cont]['tipoGrupo']			= "-";
						$dataReporte[$cont]['tipoCantidad']			= "-";
					}
					
					$dataReporte[$cont]['informacionAdicional']		= $data->info_adicional;
					$dataReporte[$cont]['informacionPagina']		= $data->pagina_web;
					
					$dataReporte[$cont]['entidadRepresentante']		= $data->registros->entidad->representante_legal;
					$dataReporte[$cont]['entidadRepresentanteId']	= $data->registros->entidad->representante_id;
					
					$dataReporte[$cont]['reporteDireccion'] 		= $data->direccion;
					$dataReporte[$cont]['reporteDepartamento']		= isset($data->county->department->department_name) ? $data->county->department->department_name : "";
					$dataReporte[$cont]['reporteCiudad'] 			= isset($data->county->county_name) ? $data->county->county_name : "";
					$dataReporte[$cont]['reporteTelefono'] 			= $data->telefono;
                    
					$cont++;
                }
            }
            
            //Yii::app()->end();
            // get a reference to the path of PHPExcel classes
            $phpExcelPath = Yii::getPathOfAlias('ext.phpexcel.Classes');
            
            // Turn off our amazing library autoload
            spl_autoload_unregister(array('YiiBase','autoload'));
            
            // making use of our reference, include the main class
            // when we do this, phpExcel has its own autoload registration
            // procedure (PHPExcel_Autoloader::Register();)
            include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');
            
            $objPhpExcel = new PHPExcel();
            
            // Once we have finished using the library, give back the
            // power to Yii...
            spl_autoload_register(array('YiiBase','autoload'));
            
            $objPhpExcel->getProperties()->setCreator("Instituto Alexander Von Humboldt")
            ->setTitle("Bitácora Colecciones")
            ->setSubject("Bitácora Colecciones")
            ->setDescription("Reporte detallado de las Colecciones Existentes");
            
            $objPhpExcel->getActiveSheet()->setTitle('Reporte RNC');
            
            $dataExcel = array();
            
            
            foreach ($dataReporte as $k => $value){
                $abc = 65;
                $abc_aux = 64;
                $mayor = false;
                foreach ($value as $j => $valueData){
					//echo $abc."/";
                    $alfa = chr($abc);
                    
                    if($abc > 90){
                        $abc = 65;
                        $abc_aux++;
                        $mayor = true;
                        $alfa = chr($abc_aux).chr($abc);
                    }else if($mayor){
                        $alfa = chr($abc_aux).chr($abc);
                    }
                    $objPhpExcel->setActiveSheetIndex(0) -> setCellValue($alfa.($k + 1), $valueData);
                    $abc++;
                }
            }
            
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="ReporteRnc.xlsx"');
            header('Cache-control: max-age=1');
            
            $objWriter = PHPExcel_IOFactory::createWriter($objPhpExcel, 'Excel2007');
            $objWriter->save('php://output');
            
            $mensaje = new Mensaje();
            $mensaje->setTitulo("Descarga exitosa");
            $mensaje->setMensaje("La descarga de la bitácora fue realizada con éxito.");
            
            $this->render('mensaje',array(
                    'model'=>$mensaje,
            ));				
            
		}
        catch (Exception $e) {
			$transaction->rollback();
			print_r($e->getMessage());
			Yii::log("Ocurrió un error al enviar la informacion de registro: " . $e->getMessage(), 'error');
			$success_saving_all = false;
			Yii::app()->end();
		}
	}

    public function actionReporteCurador(){
		$model = new Reporte();
		$fechaReporte = Yii::app()->Date->now();
        
		try{
			$criteria = new CDbCriteria;
			//$criteria->condition = "t.estado = 2";
            
            $model = curador::model();
            $modelCollections = Registros_update::model();
            $modelDepartamento=Department::model();
            $modelTipoColeccion=Tipo_Coleccion::model();
            $modelEntidad=Entidad::model();
            $modelRegistros = Registros::model();
            $modelMunicipio=County::model();
            $criteria=new CDbCriteria();
            $dataRegitros = $model->findAll($criteria);
            //Datos header excel 
            $dataReporte = array();
			$dataReporte[0]['Nombre'] 			= 'Nombre(s)';
			$dataReporte[0]['Especialidad'] 			= 'Especialidad';
			$dataReporte[0]['Telefono'] 			= 'Teléfono(s)';
			$dataReporte[0]['Email'] 			= 'Correo electrónico';
			$dataReporte[0]['Perfil'] 			= 'Perfil en linea';
			$dataReporte[0]['Grupo'] 			= 'Grupo biológico';
			$dataReporte[0]['SubGrupo'] 			= 'Subgrupo biológico';
			$dataReporte[0]['Departamento'] 			= 'Departamento';
			$dataReporte[0]['Municipio'] 			= 'Municipio';
			$dataReporte[0]['TipoColeccion'] 			= 'Tipo de colección';
			$dataReporte[0]['NameColeccion'] 			= 'Nombre de la colección';
			$dataReporte[0]['NumReg'] 			= 'Número de registro';
			$dataReporte[0]['Entidad'] 			= 'Entidad';
			
			$cont = 1;

            foreach ($dataRegitros as $curador){

                $registros_update= $modelCollections->findByPk($curador->registros_update_id);

                $registros= $modelRegistros->findByPk($registros_update->registros_id);
                $entidad=$modelEntidad->findByPk($registros->Entidad_id);
                $TipoColeccion=$modelTipoColeccion->findByPk($registros->tipo_coleccion_id);

                $department=$modelDepartamento->findByAttributes(array('iso_department_code'=>$registros_update->attributes["departamento_id"]));
                $municipio=$modelMunicipio->findByAttributes(array('iso_county_code'=>$registros_update->attributes["ciudad_id"]));
                $dataReporte[$cont]['Nombre'] 			= $curador->nombre;
                $dataReporte[$cont]['Especialidad'] 			= $curador->cargo;
                $dataReporte[$cont]['Telefono'] 			= $curador->telefono;
                $dataReporte[$cont]['Email'] 			= $curador->email;
                $dataReporte[$cont]['Perfil'] 			= $curador->pagina_web;
                $dataReporte[$cont]['Grupo'] 			= $curador->subgrupo_taxonomico->grupo_taxonomico->nombre;
                $dataReporte[$cont]['SubGrupo'] 			= $curador->subgrupo_taxonomico->nombre;
                $dataReporte[$cont]['Departamento'] 			= $department->department_name;
                $dataReporte[$cont]['Municipio'] 			= $municipio->county_name;
                $dataReporte[$cont]['TipoColeccion'] 			= $TipoColeccion->nombre;
                $dataReporte[$cont]['NameColeccion'] 			= $registros_update->nombre;
                $dataReporte[$cont]['NumReg'] 			= $registros->numero_registro;
                $dataReporte[$cont]['Entidad'] 			= $entidad->titular;
                $cont++;
            }
            //Yii::app()->end();
            // get a reference to the path of PHPExcel classes
            $phpExcelPath = Yii::getPathOfAlias('ext.phpexcel.Classes');
            
            // Turn off our amazing library autoload
            spl_autoload_unregister(array('YiiBase','autoload'));
            
            // making use of our reference, include the main class
            // when we do this, phpExcel has its own autoload registration
            // procedure (PHPExcel_Autoloader::Register();)
            include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');
            
            $objPhpExcel = new PHPExcel();
            
            // Once we have finished using the library, give back the
            // power to Yii...
            spl_autoload_register(array('YiiBase','autoload'));
            
            $objPhpExcel->getProperties()->setCreator("Lumon S.A.S")
            ->setTitle("Bitácora Curadores")
            ->setSubject("Bitácora Curadores")
            ->setDescription("Reporte detallado del directorio de especialistas Existentes");
            
            $objPhpExcel->getActiveSheet()->setTitle('Reporte RNC');
            
            $dataExcel = array();
            
            
            foreach ($dataReporte as $k => $value){
                $abc = 65;
                $abc_aux = 64;
                $mayor = false;
                foreach ($value as $j => $valueData){
					//echo $abc."/";
                    $alfa = chr($abc);
                    
                    if($abc > 90){
                        $abc = 65;
                        $abc_aux++;
                        $mayor = true;
                        $alfa = chr($abc_aux).chr($abc);
                    }else if($mayor){
                        $alfa = chr($abc_aux).chr($abc);
                    }
                    $objPhpExcel->setActiveSheetIndex(0) -> setCellValue($alfa.($k + 1), $valueData);
                    $abc++;
                }
            }
            
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="ReporteRnc.xlsx"');
            header('Cache-control: max-age=1');
            
            $objWriter = PHPExcel_IOFactory::createWriter($objPhpExcel, 'Excel2007');
            $objWriter->save('php://output');
            
            $mensaje = new Mensaje();
            $mensaje->setTitulo("Descarga exitosa");
            $mensaje->setMensaje("La descarga de la bitácora fue realizada con éxito.");
            
            $this->render('mensaje',array(
                    'model'=>$mensaje,
            ));				
            
		}
        catch (Exception $e) {
			$transaction->rollback();
			print_r($e->getMessage());
			Yii::log("Ocurrió un error al enviar la informacion de registro: " . $e->getMessage(), 'error');
			$success_saving_all = false;
			Yii::app()->end();
		}
	}
}
?>