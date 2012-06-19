moodle-mod_checklist
====================

A reworked version of checklist allowing "standard time allocation" to checked activities.

This module has several enhancements compared to the original version

1. Standard time handling

Checklist can define a "standard assignable time" for ativities it will track that will superseede real time
measurement from logs in some reports (trainingsessions)

2. Flexipage format "in-page" representation

The hecklist provides now a special "pageitem.php" file that allows changing the in-course representation of the
checklist depending on user's situation. This will work with our reworked version of flexipage format.

3. Extending completion tracking to non standard modules (generalization)

Original version of the cheklist do not provide an extensible mechanism to detet ompletion on non standard
or additional modules. This version extends the completion tracking capability to any module pursuant a

function &lt;modname&gt;_checklist_get_logaction_code()

function returns the proper log action key from a "xlib.php" file in the module implementation root. 