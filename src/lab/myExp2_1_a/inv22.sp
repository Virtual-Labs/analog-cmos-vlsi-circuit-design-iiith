*inverter
.include '45nm_HP.pm'
M1 out in Vdd Vdd PMOS l=50n w=100n
M2 out in 0 0 NMOS l=111 w=2000
cl out 0 1.0f
Vdd Vdd 0 1.1
Vin in 0 pulse (0  1.1  0 1n 1n 10n 22n )
.tran 1n 100n
.save V(out) V(in)
.end
