Material::create([
    'name' => 'Sand',
])
Material::create([
    'name' => 'Mud',
])
Material::create([
    'name' => 'Clay',
])
Material::create([
    'name' => 'Boulder',
])
Material::create([
    'name' => 'Non-Bauxite',
])
Material::create([
    'name' => 'Other',
])

Dumping::create([
    'disposial' => 'ipdsidewallutara',
    'easting' => '1',
    'northing' => '1',
    'elevation_rl' => '1',
    'elevation_actual' => '1',
    'material_id' => '1',
])




-- S: Sand (Pasir)
-- M: Mud atau Mineral (Lumpur atau Mineral)
-- C: Clay (Lempung)
-- B: Boulder atau Bedrock (Batu Besar atau Batuan Dasar)
-- NB: Non-Bauxite atau Non-Breakable (Bukan Bauksit atau Tidak Mudah Hancur)
-- OTR: Other (Lainnya)