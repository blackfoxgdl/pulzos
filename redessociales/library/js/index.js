// JavaScript Document


function update_months(meses)
{
	var dias = dijit.byId("dias").getValue(0);
	meses = meses;
	if((meses == 4 || meses == 6 || meses == 9 || meses ==1) && dias > 30)
	{
		dijit.byId("dias").reset();
		dijit.byId("dias").removeOption("31");
	}
	if(meses == 2 && dias > 28)
	{
		var arreglo = new Array(29,30,31);
		dijit.byId("dias").reset();
		dijit.byId("dias").removeOption(arreglo);
	}
	//check('', meses);
}